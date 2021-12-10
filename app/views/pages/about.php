<?php require APPROOT.'/views/inc/header.php';?>
<section class="section mt-3">
    <div class="columns">
        <div class="column has-text-centered">
            <h1 class="title is-1 has-text-white">
                Create the space for your thinking to take off.
            </h1>
        </div>
    </div>
    <hr />
    <div class="columns">
        <div class="column">
            <p class="has-text-white p-6 is-size-5">
                The best ideas can change who we are. Mudeo is where those ideas take shape, take off, and spark powerful conversations. We’re an open platform where over 100 million readers come to find insightful and dynamic thinking.
                Here, expert and undiscovered voices alike dive into the heart of any topic and bring new ideas to the surface. Our purpose is to spread these ideas and deepen understanding of the world.
                <br />
                <br />
                We’re creating a new model for digital publishing. One that supports nuance, complexity, and vital storytelling without giving in to the incentives of advertising. It’s an environment that’s open to everyone but promotes
                substance and authenticity. And it’s where deeper connections forged between readers and writers can lead to discovery and growth. Together with millions of collaborators, we’re building a trusted and vibrant ecosystem
                fueled by important ideas and the people who think about them.
            </p>
        </div>
        <div class="vl" style="border-left: 1px solid white;"></div>
        <div class="column is-flex is-justify-content-center is-align-content-center is-align-items-center">
            <div class="view">
                <div class="plane main">
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="columns">
        <div class="column">
            <p><?= $data['description']; ?></p>
            <p>
                Version:
                <?= APPVERSION; ?>
            </p>
        </div>
        <div class="column"></div>
        <div class="column"></div>
    </div>
</section>

<?php require APPROOT.'/views/inc/footer.php';?>
