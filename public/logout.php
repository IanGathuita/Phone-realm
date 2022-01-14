<?php
    require_once "../private/config.php";
    require_once "../private/db.php";
    include_once "partials/header.php";
    $_SESSION['logged-in'] = false;
    header("Location:".ROOT_URL."public/login.php");
    ?>