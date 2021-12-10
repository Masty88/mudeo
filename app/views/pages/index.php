<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="hero is-large is-custom is-relative">
    <img src="<?= URLROOT ?>/<?= $data['preview']->thumbnail; ?>" alt="" class="heroVideo" id="previewImage" hidden />
    <video id="previewVideo" class="heroVideo playIntro" controls muted autoplay id="previewVideo">
        <source src="<?= URLROOT ?>/<?= $data['preview']->preview; ?>" type="video/mp4" />
        Your browser does not support the video tag.
    </video>
    <div class="previewOverlay">
        <div class="mainDetails ml-6 is-flex is-flex-direction-column">
            <h2 class="title has-text-white is-1"><?= $data['preview']->name; ?></h2>
            <h3 class="title"></h3>
            <div class="buttons">
                <a href="<?= URLROOT ?>/pages/show/<?= $data['preview']->id ?>" class="button is-success is-medium buttonMainHero">
                    <span class="icon-text">
                        <span class="icon is-small">
                            <i class="fas fa-play"></i>
                        </span>
                        <span style="margin-top: 3%;">
                            PLAY
                        </span>
                    </span>
                </a>
                <button class="button is-danger is-medium buttonMainHero" id="mute">
                    <span class="icon is-small">
                        <i class="fas fa-volume-mute" id="iconMute"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <?php foreach ($data['categories'] as $categories) : ?>
        <div class="columns ml-6">
            <h2 class="title is-4 has-text-white"><?= $categories->mainCategories; ?></h2>
        </div>
        <div class="columns ml-6 scroll is-flex-mobile is-justify-content-center-mobile is-flex-tablet is-justify-content-center-tablet">
            <?php foreach ($data['list'] as $list) : ?>
                <?php if ($categories->id === $list->categoryId) { ?>
                    <div class="previewContainer mt-4">
                        <div class="image preview-container">
                            <img src="<?= URLROOT ?>/<?= $list->thumbnail; ?>" />
                            <div class="box actions">
                                <div class="columns" style="margin-bottom: 5px;">
                                    <div class="column" style="margin-bottom: -10px;">
                                        <h3 class="title is-6 has-text-white" style="max-width: 100%; margin-bottom: 5px;"><?= $list->filmName; ?></h3>
                                        <p class="has-text-white"><?= $list->view_count; ?> views</p>
                                    </div>
                                </div>
                                <div class="columns mobile_btn">
                                    <div class="column mr-2 is-1 is-gapless">
                                        <a href="<?= URLROOT ?>/pages/show/<?= $list->showId ?>" class="button button is-dark is-small">
                                <span class="icon is-small">
                                    <i class="fas fa-play"></i>
                                </span>
                                        </a>
                                    </div>
                                    <div class="column is-gapless">
                                        <form class="watchlist" method="post">
                                            <input class="entityId" class="input" type="hidden" value="<?= $list->showId ?>" />
                                            <?php if (!isAdded($list->showId)): ?>
                                                <button class="button change is-dark is-small">
                                    <span class="icon is-small">
                                        <i class="fas changeIcon fa-plus"></i>
                                    </span>
                                                </button>
                                            <?php else : ?>
                                                <button class="button change is-dark is-small" disabled>
                                    <span class="icon is-small">
                                        <i class="fas changeIcon fa-check"></i>
                                    </span>
                                                </button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                    <div class="column is-3 is-hidden-mobile"></div>
                                    <div class="column">
                                        <?php if (!isLiked($list->showId)): ?>
                                            <form class="likedList" method="post">
                                                <input class="entityIdLike" class="input" type="hidden" value="<?= $list->showId ?>" />
                                                <button class="button changeToLike is-dark is-small">
                                    <span class="icon is-small">
                                        <i class="fas fa-thumbs-up"></i>
                                    </span>
                                                </button>
                                            </form>
                                        <?php else : ?>
                                            <form class="unlikedList" method="post">
                                                <input class="entityIdUnLike" class="input" type="hidden" value="<?= $list->showId ?>" />
                                                <button class="button changeToUnLike is-dark is-small is-success">
                                    <span class="icon is-small">
                                        <i class="fas fa-thumbs-up"></i>
                                    </span>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>
