<?php
/**
 * @var ArrayData $data
 */
?>
<?php require_once(APPROOT . "/views/inc/header.php") ?>
<h1><?php echo $data["title"]; ?></h1>
<p>There <?php echo $data["postCount"] == 1 ? "is" : "are" ?> <?php echo $data["postCount"] ?> post<?php echo $data["postCount"] != 1 ? "s" : "" ?></p>
<ul>
    <?php foreach($data["posts"] as $post): ?>
        <li><?php echo $post->title; ?></li>
    <?php endforeach; ?>
</ul>
<hr>
<h2><?php echo $data["post"]->title; ?></h2>
<?php require_once(APPROOT . "/views/inc/footer.php") ?>