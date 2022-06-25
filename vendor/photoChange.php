<?php
    session_start();

    require_once '../config/db.php';

    $user = $_SESSION['admin'];

    $user_id = $user['id'];
    $login = $user['login'];
    $password = $user['password'];
    $newphoto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    
    unset($_SESSION['admin']);
    
    $admininfo = $_SESSION['admin'] = [
        'id' => $user_id,
        'login' => $login,
        'password' => $password,
        'photo' => $newphoto
    ];
    
    mysqli_query($connect, "UPDATE `users` SET `photo` = '$newphoto' WHERE `users`.`id_u` = $user_id");
    header('Location: ../admin-panel.php');

?>