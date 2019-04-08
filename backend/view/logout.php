<?php
session_start();
session_destroy();
header('Location: http://blog.gascanul.com');
exit;
