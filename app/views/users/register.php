<?php require APPROOT.'/views/inc/header.php';?>

<section class="hero">
    <div class="hero-body">
        <div class="container ">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-8-desktop is-8-widescreen">
                    <form id="registerForm"  class="box" action="<?= URLROOT;?>/users/register" method="post">
                        <section class="hero" >
                            <div class="hero-body">
                                <div class="container ">
                                    <h1 class="title">REGISTER</h1>
                                    <div class="columns is-centered">
                                        <div class="column is-5-tablet is-half-desktop is-5-widescreen">

                                                <!--salutation-->
                                                <div class="field" id="gender-group">
                                                    <div class="control">
                                                        <label class="radio"> </label>
                                                        <input type="radio" id="form-radio-1" name="gender" value="male">
                                                        <span>Mr</span>
                                                        <label class="radio"></label>
                                                        <input type="radio" id="form-radio-2" name="gender" value="female">
                                                        <span>Ms</span>
                                                    </div>
                                                    <span><?php if(!empty($data['gender_err'])) echo $data['gender_err']?></span>
                                                </div>

                                                <!--Name-->
                                                <div class="field" id="name-group" >
                                                    <label class="label ">Name: *</label>
                                                    <div class="control">
                                                        <input class="input <?php echo (!empty($data['name_err'])) ? 'is-danger' : ''?>" id="form-name" type="text" name="name" placeholder="Name" value="<?= $data['name']?>">
                                                    </div>
                                                    <span><?= $data['name_err']?></span>
                                                </div>


                                                <!--Email-->
                                                <div class="field" id="email-group">
                                                    <label class="label">Email</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input class="input <?php echo (!empty($data['email_err'])) ? 'is-danger' : ''?>" id="form-email" type="email" placeholder="Email input" name="email" value="<?= $data['email']?>">
                                                        <span class="icon is-small is-left">
                                                         <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <span><?= $data['email_err']?></span>
                                                </div>

                                                <!--Password-->
                                                <div class="field" id="password-group">
                                                    <label class="label">Password</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input class="input <?php echo (!empty($data['password_err'])) ? 'is-danger' : ''?>" id="form-password" type="password" placeholder="Password" name="password">
                                                        <span class="icon is-small is-left">
                                                         <i class="fas fa-key"></i>
                                                        </span>
                                                    </div>
                                                    <span><?= $data['password_err']?></span>
                                                </div>

                                                <!--Password Confirm-->
                                                <div class="field" id="password-group-confirm">
                                                    <label class="label">Password confirm</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input class="input <?php echo (!empty($data['confirm_password_err'])) ? 'is-danger' : ''?>" id="form-password-confirm" type="password" placeholder="Password" name="password_confirm">
                                                        <span class="icon is-small is-left">
                                                         <i class="fas fa-key"></i>
                                                        </span>
                                                    </div>
                                                    <span><?= $data['confirm_password_err']?></span>
                                                </div>



                                                <!--Check-->
                                                <div class="field" id="check-group">
                                                    <div class="control">
                                                        <label class="checkbox">
                                                            <input type="checkbox" id="form-checkbox" name="check"
                                                                <?php if(empty($data['check_err'])){?><?php echo "checked='checked'"?>
                                                                <?php } ?>
                                                            >
                                                            I agree to the <a href="#">terms and conditions</a>
                                                        </label>
                                                    </div>
                                                    <span><?php if(!empty($data['check_err'])) echo $data['check_err']?></span>
                                                </div>

                                                <!--Button-->
                                                <div class="field is-grouped is-flex-wrap-wrap">
                                                    <div class="control">
                                                        <button id="form-submit" class="button is-purple m-1 " name="my-form" type="submit">REGISTER</button>
                                                    </div>
                                                    <div class="control">
                                                        <button class="button is-link is-light m-1" name="login" >
                                                            <a href="<?= URLROOT;?>/users/login">
                                                                Have an account? Login
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
<?php require APPROOT.'/views/inc/footer.php';?>
