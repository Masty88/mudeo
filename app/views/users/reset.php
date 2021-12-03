<?php require APPROOT.'/views/inc/header.php';?>

<section class="hero">
    <div class="hero-body">
        <div class="container ">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-8-desktop is-8-widescreen">
                    <form id="registerForm"  class="box" action="<?= URLROOT;?>/users/reset/<?= $data['get_id']?>" method="post">
                        <section class="hero" >
                            <div class="hero-body">
                                <div class="container ">
                                    <h1 class="title">PASSWORD MODIFY</h1>
                                    <div class="columns is-centered">
                                        <div class="column is-5-tablet is-half-desktop is-5-widescreen">

                                                <!--Password-->
                                                <div class="field" id="password-group">
                                                    <label class="label">Password</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input class="input <?php echo (!empty($data['password_err'])) ? 'is-danger' : ''?>" id="form-password" type="password" placeholder="Password" name="password">
                                                        <span class="icon is-small is-left">
                                                         <i class="fas fa-envelope"></i>
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
                                                         <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <span><?= $data['confirm_password_err']?></span>
                                                </div>

                                                <!--Button-->
                                                <div class="field is-grouped">
                                                    <div class="control">
                                                        <button id="form-submit" class="button is-purple" name="my-form" type="submit">REGISTER</button>
                                                    </div>
                                                    <div class="control">
                                                        <button class="button is-link is-light" name="login" >
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

