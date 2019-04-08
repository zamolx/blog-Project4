<?php
    if (isset($_GET["error"])) {
        $error_class = "input_error";
    }
    else {
        $error_class = "";
    }
?>

<div class="simple-login-container">
    <h2>Veuillez entre votre mot de passe pour obtenir les codes d'acces au serveur:</h2>
    <form action="login.php" method="post">
    <div class="row">
        <div class="col-md-12 form-group">
             <label for="username">Username:</label>
            <input id ='username' type="text" name="username" class="form-control <?php echo $error_class; ?>" required="required">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <label for="password">Mot de passe:</label>
            <input id ='password' type="password" name="password" class="form-control <?php echo $error_class; ?>" required="required">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 form-group">
            <input type="submit" value="Submit" class="btn btn-block btn-login">
        </div>
    </div>
    
    </form>
</div>

<?php
    if (isset($_GET["error"])) {
        echo '<div class="simple-login-container" id="error_login" >
        <h2>mot de passe ou username pas correct</h2>
</div>';
    }
?>
