<?php
ob_start();
session_start();
require('controller/frontend.php');
require('controller/login_controller.php');

$action = array('listPosts','post','addComment','report','login');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        }
        else {
            listPosts();
        }
    }
    elseif($_GET['action'] == 'login') {
        if (isset($_SESSION['name'])) { header('Location: http://blog.gascanul.com/backend/adminIndex.php');}
            else {
                controlLogin();
            }
    }

    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else {
                throw new Ecception('Tous les champs ne sont pas remplis !');
            }
        }
        else {
            header('Location: view/errorView.php');
        }
    }
    elseif ($_GET['action'] == 'report') {
        report();
    }
    elseif(!in_array($_GET['action'],$action))
    {
        header('Location: view/errorView.php');
    }
}
else {
    listPosts();
}