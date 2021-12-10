<?php require APPROOT.'/views/inc/header.php';?>

<section class="section">
    <?php flash('media_message'); ?>
    <div class="columns ml-4">
        <div class="column">
            <h1 class="title is-1">Medias</h1>
        </div>
    </div>
    <div class="columns ml-5">
        <div class="column">
            <h2 class="title">
                My uploads
            </h2>
        </div>
    </div>
    <div class="columns ml-6 columns scroll is-flex-wrap-wrap ml-6">
        <?php foreach ($data['list'] as $list) : ?>
            <div class=" mt-4">
                <div class="image preview-container">
                    <img  src="<?= URLROOT?>/<?= $list->thumbnail; ?>">
                    <div class="box actions ">
                        <div class="columns" style="margin-bottom: 5px; ">
                            <div class="column" style="margin-bottom: -10px; ">
                                <h3 class="title is-6 has-text-white" style="max-width: 100%;margin-bottom: 5px; "><?= $list->name; ?></h3>
                                <p class="has-text-white"><?= $list->view_count; ?> views </p>
                            </div>
                        </div>
                        <div class="columns  mobile_btn">
                            <div class="column mr-2 is-1 is-gapless ">
                                <a href="<?= URLROOT ?>/pages/show/<?= $list->id ?>" class="button button is-dark is-small">
                                    <span class="icon is-small">
                                       <i class="fas fa-play"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column ml-1 is-1 is-gapless">
                                <form action="<?= URLROOT ?>/medias/delete/<?= $list->id ?>" method="post">
                                    <button class="button is-danger is-small">
                                         <span class="icon is-small">
                                         <i class="fas fa-minus"></i>
                                          </span>
                                    </button>
                                    </span>
                                </form>
                            </div>
                            <div class="column ml-2 ">
                                <a href="<?= URLROOT ?>/medias/modify/<?= $list->id ?>">
                                    <button class="button is-warning is-small">
                                         <span class="icon is-small">
                                         <i class="fas fa-edit"></i>
                                          </span>
                                    </button>
                                    </span>
                                </a>
                            </div>
                            <div class="column is-1 gapless"></div>
                            <div class="column">
                                <?php if(!isLiked($list->id)):?>
                                    <form class="likedList"  method="post">
                                        <input class="entityIdLike" class="input" type="hidden" value="<?= $list->id ?>">
                                        <button class="button changeToLike is-dark is-small">
                                         <span class="icon is-small">
                                          <i class="fas fa-thumbs-up"></i>
                                          </span>
                                        </button>
                                    </form>
                                <?php else :?>
                                    <form class="unlikedList"  method="post">
                                        <input class="entityIdUnLike" class="input" type="hidden" value="<?= $list->sid ?>">
                                        <button class="button changeToUnLike is-dark is-small is-success">
                                         <span class="icon is-small">
                                          <i class="fas fa-thumbs-up"></i>
                                          </span>
                                        </button>
                                    </form>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="columns ml-5">
        <div class="column">
            <h2 class="title">
                My watchlist
            </h2>
        </div>
    </div>
    <div class="columns scroll is-flex-wrap-wrap ml-6">
        <?php foreach ($data['watch_list'] as $watch_list) : ?>
            <div class="previewContainer mt-4 is-flex-mobile is-justify-content-center">
                <div class="image preview-container">
                    <img   src="<?= URLROOT?>/<?= $watch_list->thumbnail; ?>">
                    <div class="actions box ">
                        <div class="columns" style="margin-bottom: 5px; ">
                            <div class="column" style="margin-bottom: -10px; ">
                                <h3 class="title is-6 has-text-white" style="max-width: 100%;margin-bottom: 5px; "><?= $watch_list->filmName; ?></h3>
                                <p class="has-text-white"><?= $watch_list->view_count; ?> view </p>
                            </div>
                        </div>
                        <div class="columns  mobile_btn">
                            <div class="column mr-2 is-1 is-gapless">
                                <a href="<?= URLROOT ?>/pages/show/<?= $watch_list->showId ?>" class="button button is-dark is-small">
                                    <span class="icon is-small">
                                       <i class="fas fa-play"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <form action="<?= URLROOT ?>/medias/removefromwatchlist/<?= $watch_list->showId ?>" method="post">
                                    <button class="button is-danger is-small">
                                         <span class="icon is-small">
                                         <i class="fas fa-minus"></i>
                                          </span>
                                    </button>
                                    </span>
                                </form>
                            </div>
                            <div class="column is-3 is-hidden-mobile"></div>
                            <div class="column">
                                <?php if(!isLiked($watch_list->showId)):?>
                                    <form class="likedList"  method="post">
                                        <input class="entityIdLike" class="input" type="hidden" value="<?= $watch_list->showId ?>">
                                        <button class="button changeToLike is-dark is-small">
                                         <span class="icon is-small">
                                          <i class="fas fa-thumbs-up"></i>
                                          </span>
                                        </button>
                                    </form>
                                <?php else :?>
                                    <form class="unlikedList"  method="post">
                                        <input class="entityIdUnLike" class="input" type="hidden" value="<?= $watch_list->showId ?>">
                                        <button class="button changeToUnLike is-dark is-small is-success">
                                         <span class="icon is-small">
                                          <i class="fas fa-thumbs-up"></i>
                                          </span>
                                        </button>
                                    </form>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</section>

<?php require APPROOT.'/views/inc/footer.php';?>
