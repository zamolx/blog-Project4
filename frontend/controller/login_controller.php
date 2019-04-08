<?php
ob_start();
require_once('model/Login.php');

function controlLogin()
{
    $login = new Login();
    $dates = $login->extractAdmin();

    require('view/frontend/loginView.php');
}