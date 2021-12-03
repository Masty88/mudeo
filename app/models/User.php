<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findIdUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query("INSERT INTO users (name,email,password) VALUES (:name, :email , :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $req=$this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        if($row){
            $hashed_password = $row->password;

            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        }

    }

    public function stayConnected($userid)
    {

        $cookie_id = uniqid();

        $this->db->query('UPDATE users SET remember_token = :token WHERE id= :id');
        $this->db->bind(':token', $cookie_id);
        $this->db->bind(':id', $userid);

        $this->db->execute();

        setcookie('logged', $cookie_id, time() + 3600 * 24 * 30, '/');

    }

    public function stayConnectedTwo($userid)
    {

        $cookie_id = uniqid();

        $this->db->query("INSERT INTO connections_user (userId,remembertoken) VALUES (:userId,:token)");
        $this->db->bind(':token', $cookie_id);
        $this->db->bind(':userId', $userid);
       // $this->db->bind(':id', $userid);

        $this->db->execute();
        setcookie('logged', $cookie_id, time() + 3600 * 24 * 30, '/');

    }

    public function recoverToken()
    {
        $this->db->query('SELECT  * FROM connections_user WHERE remembertoken = :token');
        $this->db->bind(':token', $_COOKIE['logged']);
        $resToken = $this->db->singleAss();

        if ($resToken) {
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $resToken['userId'];
            $_SESSION['email'] = $resToken['email'];
            $_SESSION['name'] = $resToken['name'];
        }
    }

    public function getFromUser($id){
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $result=$this->db->single();
        return $result;
    }

    public function modifyAcc($data){
        $this->db->query('UPDATE users SET name = :name, email = :email WHERE id= :id');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $data['id']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteAcc($id){
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function createResetToken($userId){
        $token = bin2hex(random_bytes(16));

        $this->db->query("INSERT INTO users_reset (user_id,recover_token) VALUES (:userId,:token)");
        $this->db->bind(':token', $token);
        $this->db->bind(':userId', $userId);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function recoverResetToken($userId){
        $this->db->query('SELECT  * FROM users_reset WHERE user_id = :userId');
        $this->db->bind(':userId', $userId);
        $row=$this->db->single();
        return $row;
    }

    public function recoverResetTokenGet($token){
        $this->db->query('SELECT  * FROM users_reset WHERE recover_token = :token');
        $this->db->bind(':token', $token);
        $row=$this->db->single();
        return $row;
    }

    public function removeToken($id){
        $this->db->query('DELETE FROM users_reset WHERE recover_token = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function modifyPassword($data){
        $this->db->query('UPDATE users SET password = :password WHERE id= :id');
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function removeCookie(){
        $this->db->query('DELETE FROM connections_user WHERE remembertoken = :token');
        $this->db->bind(':token', $_COOKIE['logged']);
        $this->db->execute();
    }

}