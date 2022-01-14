<?php 
    include "partials/header.php";
    require_once "../private/config.php";
	require_once "../private/db.php";
	if(!$_SESSION['logged-in']){
        header("Location:".ROOT_URL."public/login.php");
        exit;
    }?>
<?php include "partials/footer.php" ?>