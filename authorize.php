<?php
    session_start();

    require_once 'config/db.php';

    if ($_SESSION['admin']) {
        header('Location: admin-panel.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .container-login {
            margin: 0 auto;
            width: 15%;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);  
        }
        .msg {
            border: 1px solid red;
            padding: 5px;
            text-align: center;
            font-family: sans-serif;
            font-weight: bold;
            /* text-transform: uppercase; */
        }
    </style>
</head>
<body>
    <?php
        require_once 'header.php';
    ?>
    <br>
    <form action="vendor/login.php" method="post">
        <div class="container-login">
            <h4 style="text-align: center">Вход</h4>
            <div class="form-group">
                <label>Логин</label>
                <input name="login" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Введите логин">
            </div>
            <br>
            <div class="form-group">
                <label>Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
            </div>
            <br>
            <?php
                                if ($_SESSION['message']) {
                                    echo '<p class="msg">' . $_SESSION['message'] . '</p>';
                                }
                                unset($_SESSION['message']);
                            ?>
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </form>
</body>
</html>