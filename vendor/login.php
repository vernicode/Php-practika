<?php
    session_start();

    require_once '../config/db.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);

        $admininfo = $_SESSION['admin'] = [
            'id' => $user['id_u'],
            'login' => $user['login'],
            'password' => $user['password'],
            'photo' => $user['photo']
        ];
        header('Location: ../admin-panel.php');
    } else {
        $_SESSION['message'] = 'Incorrect login or password';
        header('Location: ../authorize.php');
    }
?>