<?php /** @var TYPE_NAME $data */ ?>
<?php require APPROOT . "/views/inc/header.php"; ?>
<?php flash("login-success"); ?><?php flash("post_message"); ?>
<div class="container row mb-3 mx-auto">
    <div class="row">
        <div class="col-6">
            <h1>All Posts</h1>
        </div>
        <div class="col-6">
            <a class="btn btn-primary float-end" href="<?php echo URLROOT; ?>/post/add">
                <i class="fa-solid fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php foreach($data["posts"] as $post): ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $post->title ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Written by <?php echo $post->name ?> on <?php echo getDateFormatter($post->created_at) ?></h6>
                        <p class="card-text"><?php echo excerpt($post->body, "XXX") ?></p>
                        <a href="<?php echo URLROOT; ?>/post/show/<?php echo $post->post_id ?>" class="card-link">Read more</a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>