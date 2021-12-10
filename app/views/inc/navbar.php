<nav class="navbar p-3" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class=" has-text-white navbar-item"
        <?php if(isLoggedIn()) : ?>
            <a   href="<?= URLROOT ?>/pages/index" class="navbar-item">
                <img src="<?= URLROOT?>/img/logo.png" style="height:220px;" alt="Startseite">
            </a>
        <?php else: ?>
            <a   class="navbar-item">
                <img src="<?= URLROOT?>/img/logo.png" style="height:220px;" alt="Startseite">
            </a>
        <?php endif; ?>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-menu">
        <div class="navbar-start">
            <?php if(isLoggedIn()) : ?>
                <a  href="<?= URLROOT ?>/pages/index" class="navbar-item">
                    Home
                </a>
                <a  href="<?= URLROOT ?>/medias/index" class="navbar-item">
                    My Contents
                </a>
            <?php else: ?>
                <a   class="navbar-item">
                    Home
                </a>
                <a   class="navbar-item">
                    My Contents
                </a>
            <?php endif; ?>
            <a href="<?= URLROOT ?>/pages/about"class="navbar-item">
                About
            </a>
        </div>

        <?php if(isLoggedIn()) : ?>

            <div class="navbar-item">
                <form id="searchEngine"  class="form" method="post">
                    <div class="field has-addons">
                        <div class="control">
                            <input class="input" id="form-search" type="text" placeholder="Search" name="query">
                        </div>
                        <div class="control">
                            <button  class="button is-purple" name="my-form" type="submit">
                            <span class="icon is-small">
                           <i class="fas fa-search"></i>
                           </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <?php else: ?>

        <?php endif; ?>



        <?php if(isLoggedIn()) : ?>
            <div class="navbar-end">
                <div class="navbar-item">
                    <a href="<?=URLROOT?>/users/member">
                 <span class="icon is-large ">
                 <span class="fa">
                      <i class="fas fa-user fa-2x"></i>
                    </span>
                 </span>
                    </a>
                </div>
                <div class="navbar-item">
                    <a href="<?=URLROOT?>/medias/add">
                 <span class="icon is-large">
                 <span class="fa">
                      <i class="fas fa-upload  fa-2x"></i>
                    </span>
                 </span>
                    </a>
                </div>
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="<?= URLROOT ?>/users/logout" class="button is-danger">
                            Log out
                        </a>
                    </div>
                </div>
            </div>
        <?php  else : ?>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="<?= URLROOT ?>/users/register" class="button is-purple">
                            <strong>Sign up</strong>
                        </a>
                        <a href="<?= URLROOT ?>/users/login" class="button is-light">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div id="preloader">
    <div class="hero is-fullheight">
        <div class="hero-body">
            <div class="columns">
                <div class="column"></div>
                <div class="column">
                    <!-- Compressing bars component -->
                    <div class="bars-common bar-one"></div>
                    <div class="bars-common bar-two"></div>

                    <!-- Rotating squares component -->
                    <div class="squares-common square-one"></div>
                    <div class="squares-common square-two"></div>

                </div>
            </div>
        </div>

    </div>
</div>
