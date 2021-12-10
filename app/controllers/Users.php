<?php
/**
 * App Users Class
 * Manage all the Users Action
 */

//Todo add my Media
//Todo add biographies modifier

class Users extends Controller
{
    /**
     * @var mixed
     */
    private $userModel;

    /**
     * User constructor
     * Connection to sql model
     * Automatic connection if cookie exist
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->autoLog();
    }

    public function index()
    {
        header('location: ' . URLROOT . '/users/login');
    }

    /**
     * Function used to register a user.
     * @throws Exception if user not registered
     */
    public function register()
    {
        //Check for POST
        if (!$_SESSION['logged']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Process form

                //Sanitize
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Recover value from input
                $name = (string) $_POST['name'];
                $email = (string) $_POST['email'];
                $password = (string) $_POST['password'];
                $password_confirm = (string) $_POST['password_confirm'];

                //Init Data
                $data = [
                    'name' => trim($name),
                    'email' => trim($email),
                    'password' => trim($password),
                    'confirm_password' => trim($password_confirm),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'gender_err' => '',
                    'check_err' => '',
                ];

                //Validate
                //TODO add regex
                if (empty($email)) {
                    $data['email_err'] = "Please enter the email";
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "Email already in use";
                    }
                }

                //condition for radio
                if (!isset($_POST["gender"])) {
                    $data['gender_err'] = "please choose a gender";
                }

                if (empty($name)) {
                    $data['name_err'] = "Please enter your name";
                }

                if (empty($password)) {
                    $data['password_err'] = "Please enter the password";
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = "Password must be at least 6 characters";
                }

                if (empty($password_confirm)) {
                    $data['confirm_password_err'] = "Please enter the password";
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = "Password not match";
                    }
                }

                //condition for check box
                if (!isset($_POST["check"])) {
                    $data['check_err'] = "please accept the conditions";
                }

                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['check_err']) && empty($data['confirm_password_err'])) {
                    //Validate
                    //Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    //Register
                    if ($this->userModel->register($data)) {
                        flash('register_success', 'You are now registered');
                        header('location: ' . URLROOT . '/users/login');
                    }
                } else {
                    //Load view with errors
                    $this->view('users/register', $data);
                }
            } else {
                $data = [
                    'title' => "Register",
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
                $this->view('users/register', $data);
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Function used to log in a user.
     */
    public function login()
    {
        //Check for POST
        if (!$_SESSION['logged']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //process form
                //Sanitize
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Recover value from input
                $email = (string) $_POST['email'];
                $password = (string) $_POST['password'];

                //Init Data
                $data = [
                    'title' => "Login",
                    'email' => trim($email),
                    'password' => trim($password),
                    'email_err' => '',
                    'password_err' => '',
                ];

                //Validate
                //TODO add regex
                if (empty($email)) {
                    $data['email_err'] = "Please enter the email";
                }
                if (!$this->userModel->findUserByEmail($email)) {
                    $data['email_err'] = "No user found";
                }

                if (empty($password)) {
                    $data['password_err'] = "Please enter the password";
                }

                if (empty($data['email_err'] && $data['password_err'])) {
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if ($loggedInUser) {
                        //Create session
                        $this->createUserSession($loggedInUser);
                        //Set cookie
                        if (isset($_POST["remember_me"])) {
                            $this->createUserToken();
                        }
                    } else {
                        $data['password_err'] = "Password incorrect";
                        $this->view('users/login', $data);
                    }
                } else {
                    $this->view('users/login', $data);
                }
            } else {
                $data = [
                    'title' => "Login",
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                ];
                $this->view('users/login', $data);
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Function used to modify user information.
     * Function used to delete user account.
     * * @throws Exception if user account not delete or modify
     */
    public function member()
    {
        $account_info = $this->userModel->getFromUser($_SESSION['user_id']);

        if (!isLoggedIn()) {
            header('location: ' . URLROOT . '/users/login');
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Recover value from input
                $name = (string) $_POST['name'];
                $email = (string) $_POST['email'];

                $data = [
                    'title' => "Login",
                    "account" => $account_info,
                    'name' => $name,
                    'email' => $email,
                    'id' => $_SESSION['user_id'],
                    'name_err' => "",
                    'email_err' => "",
                ];

                //TODO add regex

                if (empty($email)) {
                    $data['email_err'] = "Please enter the email";
                } else {
                    if ($data["email"] !== $account_info->email) {
                        echo $data['email'];
                        echo $_SESSION["email"];
                        if ($this->userModel->findUserByEmail($data['email'])) {
                            $data['email_err'] = "Email already in use";
                        }
                    } else {
                        $data['email_err'] = "";
                    }
                }

                if (empty($name)) {
                    $data['name_err'] = "Please enter your name";
                }

                if (empty($data['name_err']) && empty($data['email_err'])) {
                    //Validate
                    //Register
                    if ($this->userModel->modifyAcc($data)) {
                        flash('modify_success', 'Your data are been modified');
                        header('location: ' . URLROOT . '/users/member');
                    } else {
                        flash('modify_success', 'shomething went wrong');
                        header('location: ' . URLROOT . '/users/member');
                    }
                } else {
                    //Load view with errors
                    $this->view('users/member', $data);
                }
            } else {
                $data = [
                    'title' => "Login",
                    "account" => $account_info,
                    'name' => "",
                    'email' => "",
                    'name_err' => "",
                    'email_err' => "",
                ];
                $this->view('users/member', $data);
            }
        }
    }

    /**
     * Function used to delete user information.
     * Function used to delete user account.
     * @param int
     * @throws Exception if user account not delete
     */
    public function deleteAcc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->deleteAcc($_SESSION['user_id']);
            if ($this->userModel->deleteAcc($_SESSION['user_id'])) {
                unset($_SESSION['user_id']);
                unset($_SESSION['email']);
                unset($_SESSION['name']);
                session_destroy();
                setcookie('logged', null, time() - 3600, '/');
                header('location: ' . URLROOT . '/users/login');
            } else {
                header('location: ' . URLROOT . '/users/index');
            }
        } else {
            header('location: ' . URLROOT . '/users/index');
        }
    }

    /**
     * Function used to send reset token to user
     * @throws Exception if mail not send
     */
    public function sendToken()
    {
        if (!$_SESSION['logged']) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //process form
                //Sanitize
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Recover value from input
                $email = (string) $_POST['email'];

                $data = [
                    'email' => $email,
                    'email_err' => '',
                ];

                if (empty($email)) {
                    $data['email_err'] = "Please enter the email";
                }
                if ($this->userModel->findIdUserByEmail($email)) {
                    $userId = $this->userModel->findIdUserByEmail($email)->id;
                } else {
                    $data['email_err'] = "No user found";
                }
                if (empty($data['email_err'])) {
                    $userId = $this->userModel->findIdUserByEmail($email)->id;
                    $this->userModel->createResetToken($userId);
                    $token = $this->userModel->recoverResetToken($userId)->recover_token;
                    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                    try {
                        $html =
                            '<h2 class="has-text-warning">This token is valable 1h</h2>
                        <a href="mudeo.test/users/reset/' .
                            $token .
                            '">Reset</a>';
                        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; //Enable verbose debug output
                        $mail->isSMTP(); //Send using SMTP
                        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
                        $mail->SMTPAuth = true; //Enable SMTP authentication
                        $mail->Username = 'mudeodev@gmail.com'; //SMTP username
                        $mail->Password = 'emma91020?'; //SMTP password
                        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        $mail->setFrom("mudeodev@gmail.com");
                        $mail->addAddress($data['email']);
                        $mail->addReplyTo($data['email'], "name");

                        $mail->isHTML('true');
                        $mail->Subject = 'Password reset Mudeo';
                        $mail->Body = $html;
                        $mail->AltBody = "test";

                        $mail->send();
                        flash('register_success', "token sent verify your email");
                        header('location: ' . URLROOT . '/users/login');
                    } catch (Exception $err) {
                        echo $err;
                    }
                } else {
                    $this->view('users/sendtoken', $data);
                }
            } else {
                $data = [
                    'email_err' => "",
                    'email' => "",
                ];
                $this->view('users/sendtoken', $data);
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Function used to send reset user password
     * @param $token
     * @throws Exception if password not send to sql
     */
    public function reset($token)
    {
        $user_id = $this->userModel->recoverResetTokenGet($token)->user_id;
        $creation_time = $this->userModel->recoverResetTokenGet($token)->created_at;

        if (!$_SESSION['logged']) {
            //If not expired
            if ($this->checkForExpiringToken($creation_time)) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $password = (string) $_POST['password'];
                    $password_confirm = (string) $_POST['password_confirm'];
                    $data = [
                        'password' => trim($password),
                        'password_confirm' => trim($password_confirm),
                        'password_err' => "",
                        'confirm_password_err' => "",
                        'user_id' => $user_id,
                        'get_id' => $token,
                    ];

                    if (empty($password)) {
                        $data['password_err'] = "Please enter the password";
                    } elseif (strlen($data['password']) < 6) {
                        $data['password_err'] = "Password must be at least 6 characters";
                    }

                    if (empty($password_confirm)) {
                        $data['confirm_password_err'] = "Please enter the password";
                    } else {
                        if ($data['password'] != $data['password_confirm']) {
                            $data['confirm_password_err'] = "Password not match";
                        }
                    }

                    if (empty($data['password_err']) && empty($data['confirm_password_err'])) {
                        //Validate
                        //Hash Password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        //Register
                        if ($this->userModel->modifyPassword($data)) {
                            $this->userModel->removeToken($token);
                            flash('register_success', 'Your password has been modified');
                            header('location: ' . URLROOT . '/users/login');
                        } else {
                            $this->userModel->removeToken($token);
                            flash('register_success', 'something went wrong');
                            header('location: ' . URLROOT . '/users/login');
                        }
                    } else {
                        //Load view with errors
                        $this->view('users/reset', $data);
                    }
                } else {
                    $data = [
                        'password_err' => "",
                        'confirm_password_err' => "",
                        'user_id' => $user_id,
                        'get_id' => $token,
                    ];
                    $this->view('users/reset', $data);
                }
            } else {
                $this->userModel->removeToken($token);
                flash('expired_token', "Token has expired please ask a new one", "has-text-white");
                header('location: ' . URLROOT . '/users/login');
            }
        } else {
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Check if reset token has expired
     * @param $time
     * @return bool
     */
    private function checkForExpiringToken($time): bool
    {
        $startdate = strtotime($time);
        $expire_date = strtotime("+ 1 hour", $startdate);
        $today = strtotime("today UTC");

        if ($today >= $expire_date) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Disconnect user from the application
     */
    public function logout()
    {
        $this->userModel->removeCookie();
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        session_destroy();
        setcookie('logged', null, time() - 3600, '/');
        header('location: ' . URLROOT . '/users/login');
    }

    /**
     * Create user session
     * @param $user
     */
    private function createUserSession($user)
    {
        $_SESSION['logged'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['name'] = $user->name;
        header('location: ' . URLROOT . '/pages/index');
    }

    /**
     * Create user cookie logged
     */
    private function createUserToken()
    {
        $this->userModel->stayConnectedTwo($_SESSION['user_id']);
    }

    /**
     * If exist recover the cookie
     */
    private function recoverUserToken()
    {
        $this->userModel->recoverToken();
    }

    /**
     * If cookie exist autolog the user
     */
    private function autoLog()
    {
        //TODO create function and check if there is a better place
        if (!isset($_SESSION['logged'])) {
            $_SESSION['logged'] = false;
            $_SESSION['user_id'] = null;
            $_SESSION['email'] = null;
            $_SESSION['name'] = null;
        }
        if (!$_SESSION['logged'] && isset($_COOKIE['logged'])) {
            $this->recoverUserToken();
            header('location: ' . URLROOT . '/pages/index');
        }
    }

    /**
     * Redirect to page 404
     */
    public function error()
    {
        $data = [
            'title' => "BAD REQUEST",
        ];
        $this->view("pages/404", $data);
    }
}
