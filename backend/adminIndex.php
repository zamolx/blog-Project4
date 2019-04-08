<?php
session_start();
require_once('controller/backend.php');
if (isset($_SESSION['name']))
{
 
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'admin') {
        listPosts();
    }
    elseif ($_GET['action'] == 'addPost') {
        
            if (!empty($_POST['newTitle']) && !empty($_POST['newPost'])) {

                addPost();
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
    }
    elseif ($_GET['action'] =='delete')
    {
        deletePost();
    }
    elseif($_GET['action'] == 'read')
    {
        readPost();
    }
    elseif($_GET['action'] == 'update')
    {
        
        updateView();
    }
    elseif($_GET['action'] == 'updatePost')
    {
        updatePost();
    }
    elseif($_GET['action'] == 'view_comments')
    {
        viewComments();
    }
    elseif($_GET['action'] == 'delete_comment')
    {
        deleteComment();
    }
    elseif($_GET['action'] == 'unmarked')
    {
        unmarked();
    }
}
else {
    listPosts();
}
}
else {
    header('Location: http://blog.gascanul.com/index.php?action=login' );
}

