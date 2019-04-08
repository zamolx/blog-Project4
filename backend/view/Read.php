<?php $title =$post->id; ?>
<?php ob_start();  ?>
<section class="jumbotron text-center dashboard">
 <div class="container">
      <h1 class="jumbotron-heading">Dashboard</h1>
      <p class="lead text-muted">Add posts,update and delete posts</p>
      <p>
        <a href="adminIndex.php" class="btn btn-primary my-2">Home</a>
        <a class="btn btn-warning" href="?action=update&amp;id=<?php echo $post->id;?>">update</a>
        <a class="btn btn-danger" href="?action=delete&amp;id=<?php echo $post->id;?>">delete</a>
      </p>
    </div>
</section>
<div class="container">
        <h1 class="mt-4"><?php echo htmlspecialchars($post->title) ?></h1>
        <p><?php echo 'Date create: '.$post->date_creation ?>
        <p><?php if ($post->date_modify > $post->date_creation) {echo 'Date modify: '; echo $post->date_modify;} ?></p>
    </hr>
        <p class="lead"><?php echo nl2br($post->post) ?></p></div>
<?php $content = ob_get_clean(); ?>
<?php require('template_read.php'); ?>



