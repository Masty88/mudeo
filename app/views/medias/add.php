<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="hero">

    <div class="hero-body">

        <div class="columns is-centered">
            <div class="column is-4-tablet is-5-desktop is-6-widescreen">
                <section class="hero">
                    <div class="hero-body">
                        <?php flash('media_error'); ?>
                        <div class="container ">
                            <div class="columns is-centered">
                                <div class="column">
                                    <form enctype="multipart/form-data" id="uploadForm" class="box" method="post">

                                        <h1 class="title">UPLOAD MEDIA</h1>
                                        <!--Title-->
                                        <div class="field" id="title-group">
                                            <label class="label">Title<sup>*</sup>:</label>
                                            <div class="control has-icons-left has-icons-right">
                                                <input class="input"
                                                       id="form-title" type="text" placeholder="Title" name="title">
                                                <span class="icon is-small is-left">
                                                         <i class="fas fa-heading"></i>
                                                        </span>
                                            </div>
                                        </div>

                                        <!--Description-->
                                        <div class="field" id="body-group">
                                            <label class="label">Description</label>
                                            <div class="control has-icons-left has-icons-right">
                                                <textarea class="textarea" placeholder="enter a short description" name="body" id="body-post" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <!--Category-->
                                        <div class="field" id="category-group">
                                            <label class="label">Category<sup>*</sup></label>
                                            <div class="control">
                                                <div class="select">
                                                    <select name="category_id" id="form-category">
                                                        <option> Chose type of media </option>
                                                        <option value="1" >Feature Films</option>
                                                        <option value="14"> Short Films</option>
                                                        <option value="20">Documentary</option>
                                                        <option value="13">Commercials</option>
                                                        <option value="10">Interviews</option>
                                                        <option value="18">VFX</option>
                                                        <option value="3">Game Art Animation</option>
                                                        <option value="2">Music Tracks</option>
                                                        <option value="4">Music Bases</option>
                                                        <option value="17">Music Videos</option>
                                                        <option value="19">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Cover Image-->
                                        <div class="field" id="cover-group">
                                            <label for="file-input" class="label">Cover Image<sup>*</sup><i>('jpg', 'jpeg','png')</i></label>
                                            <div class="file has-name is-fullwidth" id="file-js">
                                                <label class="file-label">
                                                    <input class="file-input" id="form-cover" type="file" name="picture">
                                                    <span class="file-cta">
                                                        <span class="file-icon">
                                                          <i class="fas fa-upload"></i>
                                                         </span>
                                                        <span class="file-label">
                                                            Choose a file…
                                                        </span>
                                                    </span>
                                                    <span class="file-name">
                                                 </span>
                                                </label>
                                            </div>
                                        </div>

                                        <!--Video-->
                                        <div class="field" id="media-group">
                                            <label for="file-input" class="label">Media<sup>*</sup><i>(mp3,wma, mp4,webm)</i></label>
                                            <div class="file has-name is-fullwidth" id="file-js-2">
                                                <label class="file-label">
                                                    <input class="file-input" type="file" name="media" id="form-media">
                                                    <span class="file-cta">
                                                        <span class="file-icon">
                                                          <i class="fas fa-upload"></i>
                                                         </span>
                                                        <span class="file-label">
                                                            Choose a file…
                                                        </span>
                                                    </span>
                                                    <span class="file-name">
                                                 </span>
                                                </label>
                                            </div>
                                        </div>

                                        <script>
                                            const fileInput = document.querySelector('#file-js input[type=file]');
                                            fileInput.onchange = () => {
                                                if (fileInput.files.length > 0) {
                                                    const fileName = document.querySelector('#file-js .file-name');
                                                    fileName.textContent = fileInput.files[0].name;
                                                }
                                            }
                                            const mediaInput = document.querySelector('#file-js-2 input[type=file]');
                                            mediaInput.onchange = () => {
                                                if (mediaInput.files.length > 0) {
                                                    const fileName = document.querySelector('#file-js-2 .file-name');
                                                    fileName.textContent = mediaInput.files[0].name;
                                                }
                                            }
                                        </script>


                                        <!--Button-->
                                        <div class="field is-grouped">
                                            <div class="control">
                                                <button id="form-submit" class="button is-purple" name="uploader"
                                                        type="submit">SUBMIT
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


<?php require APPROOT . '/views/inc/footer.php'; ?>

