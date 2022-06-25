<?php
    session_start();

    require_once '../config/db.php';

    unset($_SESSION['admin']);
    header('Location: ../index.php');
?>