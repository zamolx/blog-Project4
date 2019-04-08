<?php ob_start(); ?>
<?php $title = str_split(nl2br(htmlspecialchars($post->title)), 30)[0]; ?>

    <div class="container">
        <h1 class="mt-4"><?php echo htmlspecialchars($post->title) ?></h1>
        <p class="lead">
            by
            <a href="#">Jean Forteroche</a>
        </p>
        <p>Date initial: <?php echo $post->date_creation ?></p>
        <p><?php if ($post->date_modify > $post->date_creation) {
                echo 'Date modify: ';
                echo $post->date_modify;
            } ?></p>
        <hr>
        <p class="lead"><?php echo nl2br($post->post) ?></p></div>
    <div class="container">
        <div class="card text-white bg-primary text-center" style="max-width: 20rem;">
            <div class="card-header">Comments :</div>
        </div>
    </div>
<?php
foreach ($comments as $comment) {
    ?>
    <div class="container comments">
        <div class="card-header font-weight-bold" style="width: 18rem" ;>
            <?= htmlspecialchars($comment->author) ?>:
        </div>
        <div class="card-body">
            <h5 class="card-title "><?php echo nl2br($comment->comment) ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($comment->comment_date) ?></p>
        </div>
        <?php
        if ($comment->marked == 1) {
            ?>
            <a href="?action=report&amp;idC=<?php echo $comment->id; ?>&amp;id=<?php echo $_GET['id'] ?>" name="report"
               class="btn btn-danger" value="Report">Report</a>
            <?php
        } else {
            ?>
            <button class="btn btn-info" value="marked">It was reported</button>
            <?php
        }
        ?>
    </div>
    <?php
}
$prev = $page - 1;
$next = $page + 1;
echo "<ul class='pagination list-inline'>";
if ($page >= $first_last_page) {
    echo '<li><a href="?action=post&amp;id=' . $_GET['id'] . '&amp;page=1">First</a></li>';
}

if ($prev >= 1) {
    echo '<li><a href="?action=post&amp;id=' . $_GET['id'] . '&amp;page=' . $prev . '">Prev</a></li>';
}

if ($records_pages >= 2) {
    for ($r = 1; $r <= $records_pages; $r++) {
        $active = $r == $page ? 'class="active"' : '';
        echo '<li><a href="?action=post&amp;id=' . $_GET['id'] . '&amp;page=' . $r . '"' . $active . '>' . $r . '</a></li>';
    }
}
if ($next <= $records_pages && $records_pages >= 2) {
    echo '<li><a href="?action=post&amp;id=' . $_GET['id'] . '&amp;page=' . $next . '">Next</a></li>';
}

if ($page != $records_pages && $records_pages >= $first_last_page) {
    echo '<li><a href="?action=post&amp;id=' . $_GET['id'] . '&amp;page=' . $records_pages . '">Last</a></li>';
}
echo '</ul>';
?>
    <div class="container leave_comment">
        <h5 class="card-header text-white bg-primary" style="width: 18rem" ;>Leave a Comment:</h5>
        <div class="card-body">
            <form method="post" action="index.php?action=addComment&amp;id=<?= $post->id ?>">
                <div class="form-group">
                    <label for="author">Name </label>:
                    <input type="text" name="author" required="required" class="form-control"/></br>
                    <label for="comment">Comment</label>:
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <button name="opinion" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>