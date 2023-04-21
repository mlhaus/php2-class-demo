<?php
/**
 * @var ArrayData $data
 */
?>
<?php require_once(APPROOT . "/views/inc/header.php") ?>
    <div class="p-5 mb-4 bg-light border rounded-3 text-center container">
        <h1 class="display-4"><?php echo $data["title"] ?></h1>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <?php flash("register_fail"); ?>
            <div class="card card-body bg-light">
                <form action="<?php echo URLROOT; ?>/user/register" method="POST">
                    <div class="form-group mb-2">
                        <label for="fullName">Full Name</label>
                        <input class="form-control <?php echo !empty($data["fullName_error"]) ? "is-invalid" : "" ?>" type="text" id="fullName" name="fullName" value="<?php echo $data["fullName"] ?>">
                        <?php if(!empty($data["fullName_error"])): ?>
                        <span class="invalid-feedback"><?php echo $data["fullName_error"] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email Address</label>
                        <input class="form-control <?php echo !empty($data["email_error"]) ? "is-invalid" : "" ?>" type="text" id="email" name="email" value="<?php echo $data["email"] ?>">
                        <?php if(!empty($data["email_error"])): ?>
                            <span class="invalid-feedback"><?php echo $data["email_error"] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="fullName">Password</label>
                        <input class="form-control <?php echo !empty($data["password1_error"]) ? "is-invalid" : "" ?>" type="password" id="password1" name="password1" value="<?php echo $data["password1"] ?>">
                        <?php if(!empty($data["password1_error"])): ?>
                            <span class="invalid-feedback"><?php echo $data["password1_error"] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-2">
                        <label for="fullName">Confirm Password</label>
                        <input class="form-control <?php echo !empty($data["password2_error"]) ? "is-invalid" : "" ?>" type="password" id="password2" name="password2" value="<?php echo $data["password2"] ?>">
                        <?php if(!empty($data["password2_error"])): ?>
                            <span class="invalid-feedback"><?php echo $data["password2_error"] ?></span>
                        <?php endif; ?>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Register">
                    <a href="<?php echo URLROOT; ?>/user/login" class="btn btn-outline-primary">Have an account? Login</a>

                </form>
            </div>
        </div>
    </div>
<?php require_once(APPROOT . "/views/inc/footer.php") ?>