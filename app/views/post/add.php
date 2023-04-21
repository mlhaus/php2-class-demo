<?php /** @var TYPE_NAME $data */ ?>
<?php require APPROOT . "/views/inc/header.php"; ?>
    <div class="container">
        <a href="<?php echo URLROOT ?>/post" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> View all posts</a>
        <?php flash("post_message"); ?>
        <div class="card card-body bg-light">
            <h2>Add Post</h2>
            <form action="<?php echo URLROOT; ?>/post/add" method="POST">
                <div class="form-group mb-3">
                    <label for="post_title">Post Title: <sup>*</sup></label>
                    <input type="text" name="post_title" id="post_title" class="form-control form-control-lg <?php echo (!empty($data["post_title_error"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["post_title"]; ?>">
                    <span class="invalid-feedback"><?php echo $data["post_title_error"]; ?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="post_body">Body: <sup>*</sup></label>
                    <textarea rows="8" name="post_body" id="post_body" class="form-control form-control-lg <?php echo (!empty($data["post_body_error"])) ? "is-invalid" : ""; ?>"><?php echo $data["post_body"]; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data["post_body_error"]; ?></span>
                </div>
                <input type="submit" value="Submit" class="btn btn-secondary">
            </form>
        </div>
    </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>