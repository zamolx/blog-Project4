<?php 
$title ='Welcome '.$_SESSION['name'];
?>
<?php ob_start(); ?>

<div class="container">
        <h5 class="card-header text-white bg-primary"><?php if(isset($post) && !$post->isNew()) {echo 'Update :';} else {echo 'Add a post :';}; ?></h5>
        <div class="card-body">
          <?php if(isset($post)) 
          {
            ?>
            <form method="post" action="?action=updatePost&amp;id=<?php echo $post->id;?>">
              <?php
            }
            else
            {
              ?>
              <form method="post" action="?action=addPost">
                <?php
              }
              ?>
                <div class="form-group">
                    <label for="newTitle">Title </label>:
                    <input type="text" name="newTitle" required="required" class="form-control" value="<?php if(isset($post))echo $post->title ?>"/></br>
                    <label for="newPost">Post</label>:
                    <textarea name="newPost" class="form-control" rows="3"><?php if(isset($post))echo $post->post ?></textarea>
                </div>
                <?php
                if (isset($post) && !$post->isNew())
                {
                  ?>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <?php
                }
                  else 
                  {
                    ?>
                <button type="submit" class="btn btn-primary">Add post</button>
                <?php
              }?>
            </form>
      
        </div>
    </div>
<div class="table-responsive" >
<table class="table table-hover">
 <thead>
    <tr>
      <th>Title</th>
      <th>View</th>
      <th>Update</th>
      <th>Delete</th>
      <th>Comments</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($posts as $post) {
    ?>
  <tr>
    <th><?php echo $post ->title;?></th>
    <th><a class="btn btn-info" href="?action=read&amp;id=<?php echo $post->id;?>">view</a></th>
    <th><a class="btn btn-warning" href="?action=update&amp;id=<?php echo $post->id;?>">update</a></th>
    <th><a class="btn btn-danger" href="?action=delete&amp;id=<?php echo $post->id;?>">delete</a></th>
    <th><a class="btn btn-info" href="?action=view_comments&amp;id=<?php echo $post->id;?>">comments</a></th>
  </tr>
    <?php
}

echo '</tbody></table></div>';

?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

