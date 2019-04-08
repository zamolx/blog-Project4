<?php $title = "Billet simple pour l'Alaska";
?>
<?php ob_start(); ?>
<?php
echo '<div class="container">
    <div class="row">
      <div class="col-lg-12">';

foreach ($posts as $post) {
    ?>
    <h1 class="mt-4"><?= htmlspecialchars($post->title) ?></h1>
    <p class="lead">
        by
        <a href="#">Jean Forteroche</a>
    </p>
    <hr>
    <p><?php echo 'Date create: ';
        echo $post->date_creation ?></p>
    <p><?php if ($post->date_modify > $post->date_creation) {
            echo 'Date modify: ';
            echo $post->date_modify;
        } ?></p>
    <hr>
    <p class="lead"><?= str_split(nl2br($post->post), 300)[0] ?><a
                href="index.php?action=post&amp;id=<?= $post->id ?>">.....More</a></p>
    <hr>
    <?php
}

echo '</div></div></div>';
$prev = $page - 1;
$next = $page + 1;
echo "<ul class='pagination list-inline'>";
if ($page >= $first_last_page) {
    echo '<li><a href="?page=1">First</a></li>';
}

if ($prev >= 1) {
    echo '<li><a href="?page=' . $prev . '">Prev</a></li>';
}

if ($records_pages >= 2) {
    for ($r = 1; $r <= $records_pages; $r++) {
        $active = $r == $page ? 'class="active"' : '';
        echo '<li><a href="?page=' . $r . '"' . $active . '>' . $r . '</a></li>';
    }
}
if ($next <= $records_pages && $records_pages >= 2) {
    echo '<li><a href="?page=' . $next . '">Next</a></li>';
}

if ($page != $records_pages && $records_pages >= $first_last_page) {
    echo '<li><a href="?page=' . $records_pages . '">Last</a></li>';
}
echo '</ul>';
?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

