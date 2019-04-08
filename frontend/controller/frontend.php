<?php
ob_start();
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    
    $postManager = new PostManager();
    $split_pages =3;
    $first_last_page = 5;
    if(isset($_GET['page'])){$page= $_GET['page'];}
    else {$page=1;}
    if($page =='' || $page ==1) {$page1=0;} 
    else {$page1= ($page*$split_pages)-$split_pages;}
    $posts = $postManager->getPosts($page1,$split_pages);
    $records_pages = $postManager->getNumberRows($split_pages);
    if (isset($_GET['page']) && ($_GET['page'] > $records_pages)) { header('Location: view/errorView.php');}
    require('view/frontend/indexView.php');
}

function post()
{
    $split_pages =4;
    $first_last_page = 3;
    if(isset($_GET['page'])){$page= $_GET['page'];}
    else {$page=1;}
    if($page =='' || $page ==1) {$page1=0;} 
    else {$page1= ($page*$split_pages)-$split_pages;}
    $commentManager = new CommentManager();
    $comments = $commentManager->getComments($_GET['id'],$page1,$split_pages);
    $records_pages = $commentManager->getNumberRows($split_pages,$_GET['id']);
    $postManager_array = new PostManager();
    $ids_array = $postManager_array->Array();
    if (isset($_GET['page']) && ($_GET['page'] > $records_pages)) { header('Location: view/errorView.php');}
    if(!in_array($_GET['id'],$ids_array)) { header('Location: view/errorView.php');}
    else {$postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
    require('view/frontend/postView.php');}
    
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function report()
{
    $commentManager = new CommentManager();
    $affectedLine=$commentManager->updateComment(2,$_GET['idC']);
    if ($affectedLine === false) {
        throw new Exception('Impossible d\'ajouter les options !');
    }
    else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
}
