<?php
require_once('model/PostManagerBackend.php');
require_once('model/CommentManagerBackend.php');

function listPosts()
{
    
    $postManager = new PostManagerBackend();
    $posts = $postManager->getPostsBackend();
    require('view/adminView.php');
}

function addPost()
{
	$postManager = new PostManagerBackend();
    $postManager->createPost($_POST['newTitle'],$_POST['newPost']);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: adminIndex.php?action=admin');
    }
}

function deletePost()
{
	$postManager = new PostManagerBackend();
    $post = $postManager->getPostBackend($_GET['id']);
    $postManager->deleteComments($post);
	$postManager->deletePost($post);
    listPosts();
}

function readPost()
{
    $postManager = new PostManagerBackend();
    $post = $postManager->getPostBackend($_GET['id']);
    require('view/Read.php');
}

function updateView()
{
    $postManager = new PostManagerBackend();
    $post = $postManager->getPostBackend($_GET['id']);
    $posts = $postManager->getPostsBackend();
    require('view/adminView.php');
}

function updatePost()
{
    $postManager = new PostManagerBackend();
    $postManager->updatePost($_GET['id'],$_POST['newTitle'],$_POST['newPost']);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'update post !');
    }
    else {
        header('Location: adminIndex.php?action=admin');
    }   
}

function viewComments()
{
    $comments = new CommentManagerBackend();
    $comments = $comments->getComments($_GET['id']);
    require('view/view_comments.php');
}

function deleteComment()
{
    $commentManagerBackend = new CommentManagerBackend();
    $comment = $commentManagerBackend->getComment($_GET['idC']);
    $commentManagerBackend->deleteComment($comment);
    viewComments();
}

function unmarked()
{
    $comment = new CommentManagerBackend();
    $comment=$comment->updateComment(1,$_GET['idC']);
     if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: adminIndex.php?action=view_comments&id='.$_GET['id']);
    }    
}
