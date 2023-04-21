<?php
/**
 * @var ArrayData $data
 */
?>
<?php require_once(APPROOT . "/views/inc/header.php") ?>
    <div class="p-5 mb-4 bg-light border rounded-3 text-center container">
        <h1 class="display-4">Welcome to <?php echo SITENAME ?></h1>
        <p class="lead"><?php echo $data["description"] ?></p>
    </div>
<?php require_once(APPROOT . "/views/inc/footer.php") ?>