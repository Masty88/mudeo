<?php require APPROOT.'/views/inc/header.php';?>
<section class="hero">
    <video class="bk playIntro" muted loop>
        <source src="<?=URLROOT?>/vid/bk.webm" type="video/mp4" />
        Your browser does not support the video tag.
    </video>
    <audio id="audioIntro">
        <source src="<?=URLROOT?>/audio/bk.mp3" type="audio/mpeg" style="visibility: hidden; position: absolute;" />
        Your browser does not support the video tag.
    </audio>
    <div class="intro-login">
        <div class="mainDetails ml-6 is-flex is-flex-direction-column">
            <div class="buttons">
                <button class="button is-danger is-medium buttonMainHero is-hidden-mobile" id="mute">
                    <span class="icon is-small">
                        <i class="fas fa-volume-mute" id="iconMute"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-4-tablet is-5-desktop is-5-widescreen">
                    <section class="hero">
                        <div class="hero-body">
                            <div class="container">
                                <div class="columns is-centered">
                                    <div class="column">
                                        <form id="contactForm" action="<?= URLROOT;?>/users/sendtoken" class="box" method="post">
                                            <h1 class="title">Reset your password</h1>
                                            <!--Email-->
                                            <div class="field" id="email-group">
                                                <label class="label">Email</label>
                                                <div class="control has-icons-left has-icons-right">
                                                    <input class="input <?php echo (!empty($data['email_err'])) ? 'is-danger' : ''?>" id="form-email" type="email" placeholder="Email input" name="email" value="<?= $data['email']?>" />
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <span><?= $data['email_err']?></span>
                                            </div>

                                            <!--Button-->
                                            <div class="field is-grouped mt-4 is-flex-wrap-wrap">
                                                <div class="control">
                                                    <button id="form-submit" class="button is-purple m-1" name="my-form" type="submit">SEND</button>
                                                </div>
                                                <div class="control">
                                                    <button class="button is-link is-light m-1" name="login">
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
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT.'/views/inc/footer.php';?>
