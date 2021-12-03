<?php require APPROOT.'/views/inc/header.php';?>

<section class="hero">

    <div class="hero-body">

            <div class="columns is-centered">
                <div class="column is-4-tablet is-5-desktop is-6-widescreen">
                    <section class="hero" >
                        <div class="hero-body">
                            <div class="container ">
                                <div class="columns is-centered">
                                    <div class="column">
                                        <form id="contactForm" action="<?= URLROOT;?>/posts/add" class="box" method="post">

                                            <h1 class="title">UPLOAD MEDIA</h1>
                                            <!--Title-->
                                            <div class="field" id="title-group">
                                                <label class="label">Title:</label>
                                                <div class="control has-icons-left has-icons-right">
                                                    <input class="input <?php echo (!empty($data['title_err'])) ? 'is-danger' : ''?>" id="form-email" type="text" placeholder="Title" name="title" value="<?= $data['title']?>">
                                                    <span class="icon is-small is-left">
                                                         <i class="fas fa-heading"></i>
                                                        </span>
                                                </div>
                                                <span><?= $data['title_err']?></span>
                                            </div>

                                            <!--Password-->
                                            <div class="field" id="body-group">
                                                <label class="label">Body</label>
                                                <div class="control has-icons-left has-icons-right">
                                                    <textarea class="textarea <?php echo (!empty($data['body_err'])) ? 'is-danger' : ''?>" id="body-post" type="password" placeholder="Password" name="body" >
                                                        <?= $data['body']?>
                                                    </textarea>
                                                </div>
                                                <span><?= $data['body_err']?></span>
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
                                                    <button id="form-submit" class="button is-purple" name="my-form" type="submit">SUBMIT</button>
                                                </div>
                                                <div class="control">
                                                    <button class="button is-link is-light" name="login" >
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
</section>


                    <?php require APPROOT.'/views/inc/footer.php';?>

