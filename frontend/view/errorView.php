<?php $title = 'Error'; ?>
<?php ob_start(); ?>
    <div class="container" style="margin-top:50px">
        <h1 class="center" style="font-size: 3rem; margin-top: 20;">Error 404 -Page not found</h1>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('frontend/template.php'); ?>