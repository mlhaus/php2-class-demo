<?php /** @var TYPE_NAME $data */ ?>
<?php require APPROOT . "/views/inc/header.php"; ?>
<div class="container">
    <a href="<?php echo URLROOT ?>/post" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> View all posts</a>
    <h2><?php echo $data["post"]->title ?></h2>
    <div class="bg-secondary text-white p-2 mb-3">Written by <?php echo $data["post"]->name ?> on <?php echo getDateFormatter($data["post"]->created_at) ?></div>
    <p><?php echo $data["post"]->body; ?></p>
    <?php // change this if statement based on the privileges you define as who can edit content ?>
    <?php // for the capstone project, you could do something like this ?>
    <?php // if($_SESSION["admin"] == 1 && $_SESSION["status"] == "active"): ?>
    <?php if($data["post"]->user_id == $_SESSION["userId"]): ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/post/edit/<?php echo $data["post"]->post_id; ?>" class="btn btn-dark">Edit Post</a>
    <a href="<?php echo URLROOT; ?>/post/delete/<?php echo $data["post"]->post_id; ?>" class="btn btn-danger float-end">Delete Post</a>

    <?php endif; ?>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>
