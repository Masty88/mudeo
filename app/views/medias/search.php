<?php require APPROOT.'/views/inc/header.php';?>


<section class="section">

    <div class="columns ml-4"><?php flash('search_message'); ?></div>
    <div class="columns is-flex-wrap-wrap ml-4">
        <?php foreach ($data['search_list'] as $search_list) : ?>
            <div class="previewContainer mt-4">
                <div class="image preview-container">
                    <img   src="<?= URLROOT?>/<?= $search_list->thumbnail; ?>">
                    <div class="box actions ">
                        <div class="columns" style="margin-bottom: 5px; ">
                            <div class="column" style="margin-bottom: -10px; ">
                                <h3 class="title is-6 has-text-white" style="max-width: 100%;margin-bottom: 5px; "><?= $search_list->name; ?></h3>
                                <p class="has-text-white"><?= $search_list->view_count; ?> view </p>
                            </div>
                        </div>
                        <div class="columns is-vcentered p-2">
                            <div class="column mr-2 is-1">
                                <a href="<?= URLROOT ?>/pages/show/<?= $search_list->id ?>" class="button button is-dark is-small">
                                    <span class="icon is-small">
                                       <i class="fas fa-play"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <form class="watchlist"  method="post">
                                    <input class="entityId" class="input" type="hidden" value="<?= $search_list->id ?>">
                                    <?php if(!isAdded($search_list->id)):?>
                                        <button class="button change is-dark is-small">
                                         <span class="icon is-small">
                                         <i class="fas changeIcon fa-plus"></i>
                                          </span>
                                        </button>
                                    <?php else :?>
                                        <button class="button change is-dark is-small" disabled>
                                         <span class="icon is-small">
                                         <i class="fas changeIcon fa-check"></i>
                                         </span>
                                        </button>
                                    <?php endif;?>
                                </form>
                            </div>
                            <div class="column is-5"></div>
                            <div class="column">
                                <?php if(!isLiked($search_list->id)):?>
                                    <form class="likedList"  method="post">
                                        <input class="entityIdLike" class="input" type="hidden" value="<?= $search_list->id ?>">
                                        <button class="button changeToLike is-dark is-small">
                                         <span class="icon is-small">
                                          <i class="fas fa-thumbs-up"></i>
                                          </span>
                                        </button>
                                    </form>
                                <?php else :?>
                                    <form class="unlikedList"  method="post">
                                        <input class="entityIdUnLike" class="input" type="hidden" value="<?= $search_list->id ?>">
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