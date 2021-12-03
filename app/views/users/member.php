<?php require APPROOT.'/views/inc/header.php';?>

<div class="columns">
    <div class="column is-2">
        <section class="section">
            <aside class="menu">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a id="personalInfoBtn">Personal Information</a></li>
                    <li><a id="bioBtn">Biography</a></li>
                    <li><a id="mediaBtn">Mes medias</a></li>
                </ul>
            </aside>

        </section>
    </div>
    <div class="column">
        <section id="personalInfo"  class="hero">
            <div class="hero-body">
                <div class="container ">
                    <div class="columns is-centered">

                        <div class="column is-5-tablet is-8-desktop is-8-widescreen">
                            <?php flash('modify_success');?>
                            <form id="modifyForm" action="<?= URLROOT;?>/users/member"   class="box" method="post">
                                <section class="hero" >
                                    <div class="hero-body">
                                        <div class="container ">
                                            <div class="columns is-centered">
                                                <div class="column is-5-tablet is-half-desktop is-5-widescreen">

                                                    <!--Name-->
                                                    <div class="field" id="name-group" >
                                                        <label class="label ">Name:</label>
                                                        <div class="control">
                                                            <input class="input <?php echo (!empty($data['name_err'])) ? 'is-danger' : ''?>" id="form-name" type="text" name="name" placeholder="Name" value="<?= $data['account']->name?>">
                                                        </div>
                                                        <span><?= $data['name_err']?></span>
                                                    </div>

                                                    <!--Email-->
                                                    <div class="field" id="email-group">


                                                        <label class="label">Email</label>
                                                        <div class="control has-icons-left has-icons-right">
                                                            <input class="input <?php echo (!empty($data['email_err'])) ? 'is-danger' : ''?>" id="form-email" type="email" placeholder="Email input" name="email" value="<?= $data['account']->email?>" >
                                                            <span class="icon is-small is-left">
                                                         <i class="fas fa-envelope"></i>
                                                        </span>
                                                        </div>
                                                        <span><?= $data['email_err']?></span>
                                                    </div>



                                                    <!--Button-->
                                                    <div class="field is-grouped">
                                                        <div class="control">
                                                            <button id="form-modify" class="button is-purple" name="account-modify" >MODIFY</button>
                                                        </div>
                                                        <div class="control">
                                                            <button id="btn" class="button is-danger" name="delete" >
                                                                    DELETE ACCOUNT
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                            <div class="modal" id="myModal">
                                <div class="modal"></div>
                                <div class="modal-card">
                                    <header class="modal-card-head" style="background: #F207A0; color: white">
                                        <p>Are you this action is irreversible</p>
                                    </header>
                                    <footer class="modal-card-foot">
                                        <form id="modifyForm" action="<?= URLROOT;?>/users/deleteacc"   method="post">
                                        <button class="button is-danger" name="delete">DELETE</button>
                                        </form>
                                        <button class="button ml-2" data-bulma-modal="close">Cancel</button>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="bio" style="display: none"  class="hero">
            <div class="hero-body">
                <div class="container ">
                    <div class="columns is-centered">
                        <div class="column is-5-tablet is-8-desktop is-8-widescreen">
                            <form id="modifyForm"  class="box" method="post">
                                <section class="hero" >
                                    <div class="hero-body">
                                        <div class="container ">
                                            <div class="columns is-centered">
                                                <div class="column is-5-tablet is-half-desktop is-5-widescreen">


                                                    <!--Name-->
                                                    <div class="field" id="name-group" >
                                                        <label class="label ">Name:</label>
                                                        <div class="control">
                                                            <input class="input " id="form-name" type="text" name="name" placeholder="Name" value="<?= $_SESSION['name']?>" disabled>
                                                        </div>
                                                    </div>

                                                    <!--Button-->
                                                    <div class="field is-grouped">
                                                        <div class="control">
                                                            <button id="form-modify" class="button is-purple" name="account-modify" >MODIFY</button>
                                                        </div>
                                                        <div class="control">
                                                            <button class="button is-danger" name="delete" >
                                                                <a class="has-text-white" href="<?= URLROOT;?>/users/delete">
                                                                    DELETE ACCOUNT
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="media" style="display: none"  class="hero">
            <div class="hero-body">
                <div class="container ">
                    <div class="columns is-centered">
                        <div class="column is-5-tablet is-8-desktop is-8-widescreen">
                            <form id="modifyForm"  class="box" method="post">
                                <section class="hero" >
                                    <div class="hero-body">
                                        <div class="container ">
                                            <div class="columns is-centered">
                                                <div class="column is-5-tablet is-half-desktop is-5-widescreen">


                                                    <!--Name-->
                                                    <div class="field" id="name-group" >
                                                        <label class="label ">Name:</label>
                                                        <div class="control">
                                                            <input class="input " id="form-name" type="text" name="name" placeholder="Name" value="<?= $_SESSION['name']?>" disabled>
                                                        </div>
                                                    </div>

                                                    <!--Button-->
                                                    <div class="field is-grouped">
                                                        <div class="control">
                                                            <button id="form-modify" class="button is-purple" name="account-modify" >MODIFY</button>
                                                        </div>
                                                        <div class="control">
                                                            <button class="button is-danger" name="delete" >
                                                                <a class="has-text-white" href="<?= URLROOT;?>/users/delete">
                                                                    DELETE ACCOUNT
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>



    <?php require APPROOT.'/views/inc/footer.php';?>
