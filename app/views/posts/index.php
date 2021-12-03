<?php require APPROOT.'/views/inc/header.php';?>
<?php flash('post_message'); ?>
<div class="columns">
    <div class="column">
        <h1 class="title">Medias</h1>
    </div>
    <div class="column">
        <a href="<?= URLROOT; ?>/posts/add">add</a>
    </div>
</div>

<div class="columns">
    <?php foreach ($data['posts'] as $post) : ?>
    <div class="column">
        <div class="card">
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-48x48">
                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4"><?= $post->title; ?> </p>
                        <p class="subtitle is-6"><?= $post->name; ?></p>
                    </div>
                </div>

                <div class="content">
                    <?= $post->body; ?>
                    <a href="#">#css</a> <a href="#">#responsive</a>
                    <br>
                    <time datetime="2016-1-1"><?= $post->postCreated; ?> </time>
                    <a href="<?= URLROOT ?>/posts/show/<?= $post->postsId?>" class="button">SHOW</a>
                </div>
            </div>
        </div>

    </div>
    <?php endforeach; ?>
</div>

<?php require APPROOT.'/views/inc/footer.php';?>
