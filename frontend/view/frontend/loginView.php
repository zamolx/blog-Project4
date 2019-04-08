<?php ob_start(); ?>
require
<?php
session_start();
if (!isset($_POST['password']) AND !isset($_POST['username'])) {
    $error_class = "";
    require('form.php');
} elseif ((isset($_POST['username']) AND $_POST['username'] != $dates['username'])
    OR (isset($_POST['password']) AND sha1($_POST['password']) != $dates['password'])) {
    $error_class = "input_error";
    require('form.php');
} else {

    $_SESSION['name'] = $dates['username'];
    header("Location: ../backend/adminIndex.php");
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('template_login.php'); ?>
