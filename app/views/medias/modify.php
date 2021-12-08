<?php require APPROOT.'/views/inc/header.php';?>

<section class="hero">
    <div class="hero-body">
        <div class="columns is-centered">
            <div class="column is-4-tablet is-5-desktop is-6-widescreen">
                <section class="hero">
                    <div class="hero-body">
                        <?php flash('media_error'); ?>
                        <?php flash('media_message'); ?>
                        <div class="container">
                            <div class="columns is-centered">
                                <div class="column">
                                    <form enctype="multipart/form-data" action="<?= URLROOT; ?>/medias/modify/<?= $data['entity']->id ?>" class="box" method="post">
                                        <h1 class="title">MODIFY MEDIA</h1>
                                        <!--Title-->
                                        <div class="field" id="title-group">
                                            <label class="label">Title<sup>*</sup>:</label>
                                            <div class="control has-icons-left has-icons-right">
                                                <input class="input <?php echo (!empty($data['title_err'])) ? 'is-danger' : '' ?>" id="form-email" type="text" placeholder="Title" name="title" value="<?= $data['entity']->name ?>" />
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-heading"></i>
                                                </span>
                                            </div>
                                            <span><?= $data['title_err'] ?></span>
                                        </div>

                                        <!--Description-->
                                        <div class="field" id="body-group">
                                            <label class="label">Description</label>
                                            <div class="control has-icons-left has-icons-right">
                                                <textarea class="textarea has-text-left" name="body" id="body-post" rows="10">
                                                <?= $data['entity']->description; ?>
                                                </textarea>
                                            </div>
                                            <span><?= $data['body_err'] ?></span>
                                        </div>

                                        <!--Category-->
                                        <div class="field">
                                            <label class="label">Category<sup>*</sup></label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="category_id" class="<?php echo (!empty($data['category_err'])) ? 'is-danger' : '' ?>">
                                                        <option> Chose type of media </option>
                                                        <option>Feature Films</option>
                                                        <option> Short Films</option>
                                                        <option>Documentary</option>
                                                        <option>Commercials</option>
                                                        <option>Interviews</option>
                                                        <option>VFX</option>
                                                        <option>Game Art Animation</option>
                                                        <option>Music Tracks</option>
                                                        <option>Music Bases</option>
                                                        <option>Music Videos</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <span><?= $data['category_err'] ?></span>
                                        </div>

                                        <div class="field">
                                            <figure class="image">
                                                <img src="<?= URLROOT?>/<?= $data['entity']->thumbnail; ?>" alt="thumb" />
                                            </figure>
                                        </div>

                                        <!--Cover Image-->
                                        <div class="field" id="body-group">
                                            <label for="file-input" class="label">Cover Image<sup>*</sup></label>
                                            <div class="file has-name is-fullwidth" id="file-js">
                                                <label class="file-label">
                                                    <input class="file-input" type="file" name="picture" />
                                                    <span class="file-cta">
                                                        <span class="file-icon">
                                                            <i class="fas fa-upload"></i>
                                                        </span>
                                                        <span class="file-label">
                                                            Choose a file…
                                                        </span>
                                                    </span>
                                                    <span class="file-name"> </span>
                                                </label>
                                            </div>
                                            <span><?= $data['cover_err'] ?></span>
                                        </div>

                                        <script>
                                            const fileInput = document.querySelector("#file-js input[type=file]");
                                            if (fileInput) {
                                                fileInput.onchange = () => {
                                                    if (fileInput.files.length > 0) {
                                                        const fileName = document.querySelector("#file-js .file-name");
                                                        fileName.textContent = fileInput.files[0].name;
                                                    }
                                                };
                                            }

                                            const mediaInput = document.querySelector("#file-js-2 input[type=file]");
                                            if (mediaInput) {
                                                mediaInput.onchange = () => {
                                                    if (mediaInput.files.length > 0) {
                                                        const fileName = document.querySelector("#file-js-2 .file-name");
                                                        fileName.textContent = mediaInput.files[0].name;
                                                    }
                                                };
                                            }
                                        </script>

                                        <!--Button-->
                                        <div class="field is-grouped">
                                            <div class="control">
                                                <button id="form-submit" class="button is-purple" name="uploader" type="submit">SUBMIT</button>
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

<?php require APPROOT . '/views/inc/footer.php'; ?>
