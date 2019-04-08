<?php $title =$_GET['id'];
$error_class = "input_error"?>
<?php ob_start(); ?>
<?php
foreach ($comments as $comment) {
    ?>
    <div class="container comments <?php if ($comment->marked == 2){echo $error_class;} ?>">
        <div class="card-header title_comment">
            <?= htmlspecialchars($comment->author) ?>
        </div>
        <div class="card-body ">
            <h5 class="card-title "><?php echo nl2br($comment->comment) ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($comment->comment_date) ?></p>
        </div>
        <a class="btn btn-danger" href="?action=delete_comment&amp;id=<?php echo $_GET['id'];?>&amp;idC=<?php echo $comment->id;?>">Delete</a>
        <?php if ($comment->marked == 2) {
        ?>
        <a class="btn btn-success" href="?action=unmarked&amp;id=<?php echo $_GET['id'];?>&amp;idC=<?php echo $comment->id;?>">Unmarked</a>
        <?php
        }
        ?>
    </div>
    <?php
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>