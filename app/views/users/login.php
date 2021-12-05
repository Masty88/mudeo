<?php require APPROOT.'/views/inc/header.php';?>

<section class="hero">
    <video class="bk playIntro" muted loop>
        <source src="<?=URLROOT?>/vid/bk.webm" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="intro-login">
        <div class="mainDetails ml-6 is-flex is-flex-direction-column">
            <div class="buttons">
                <button class="button is-danger is-medium buttonMainHero is-hidden-mobile" id="mute" >
                                    <span class="icon is-small">
                                       <i class="fas fa-volume-mute" id="iconMute"></i>
                                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="columns mb-6 is-hidden-mobile"></div>
    <div class="columns mb-6 is-hidden-mobile"></div>
    <div class="columns">
        <div class="hero-body p-0 ">
            <div class="container ">
                <div class="columns is-centered">
                    <div class="column is-12-mobile p-1 is-4-tablet is-5-desktop is-5-widescreen">
                        <section class="hero" >
                            <div class="hero-body">
                                <div class="container ">

                                    <div class="columns is-centered">

                                        <div class="column">

                                            <?php flash('register_success');?>
                                            <?php flash('expired_token');?>
                                            <form id="contactForm" action="<?= URLROOT;?>/users/login" class="box" method="post">

                                                <h1 class="title"><?= $data['title']?></h1>
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
                                                        <input class="input <?php echo (!empty($data['password_err'])) ? 'is-danger' : ''?>" id="form-password" type="password" placeholder="Password" name="password"  value="<?= $data['password']?>">
                                                        <span class="icon is-small is-left">
                                                         <i class="fas fa-key"></i>
                                                        </span>
                                                    </div>
                                                    <span><?= $data['password_err']?></span>
                                                </div>


                                                <!--Check-->
                                                <div class="field" id="check-group">
                                                    <div class="control">
                                                        <label class="checkbox">
                                                            <input type="checkbox" id="form-checkbox" name="remember_me">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                </div>

                                                <!--Button-->
                                                <div class="field is-grouped">
                                                    <div class="control">
                                                        <a href="<?= URLROOT;?>/users/sendtoken">
                                                            Forgot your password?
                                                        </a>
                                                    </div>
                                                </div>

                                                <!--Button-->
                                                <div class="field is-grouped is-flex-wrap-wrap">
                                                    <div class="control">
                                                        <button id="form-submit" class="button is-purple m-1 " name="my-form" type="submit">LOGIN</button>
                                                    </div>
                                                    <div class="control">
                                                        <button class="button is-link is-light m-1" name="login" >
                                                            <a href="<?= URLROOT;?>/users/register">
                                                                Don't have an account?
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
    </div>

</section>
                    <?php require APPROOT.'/views/inc/footer.php';?>
