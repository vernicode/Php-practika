<?php
    session_start();

    if (!$_SESSION['admin']) {
        header('Location: /authorize.php');
    }
    require_once 'config/db.php';

    $profile = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .avatar-undef {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .avatar-def {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .container-profile {
            display: flex;
            padding: 20px;
            border-right: 1px solid black;
            border-left: 1px solid black;
            margin-bottom: 20px;
        }
        .profile-img {
            margin-right: 20px;
            display: flex;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }
        .info-item {
            display: flex;
        }
        .container-info {
            display: flex;
            padding: 20px;
            background-image: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);
            border: 1px solid black;
            height: 100%;
        }
    </style>
</head>
<body>
    <?php
        require_once 'header.php';
    ?>
    <br>
    <div class="container">
        <div class="container-profile">
            <div class="profile-img">
            <?php
                $show_img = base64_encode($profile['photo']);
                if ($_SESSION['admin']) {
                ?>
                <?php
                    if ($profile['photo']) {
                ?>
                    <img src="data:image/jpeg;base64, <?php echo $show_img ?>" class='avatar-def'>
                <?php
                    } else{
                ?>
                    <img src="src/images/icons8-no-image-50.png" class='avatar-undef'>
                <?php
                    }
                ?>
                <?php
                    }
                ?>
            </div>
            <div class="profile-info">
                <div class="info-item">
                    <label for="prof-log"><b>Login:&nbsp</b></label><p id="prof-log"><?= $profile['login'] ?></p>
                </div>
                <div class="info-item">
                    <?php $password = str_repeat("*", strlen($profile['password'])) ?>
                    <label for="prof-pass"><b>Password:&nbsp</b></label><p type="password" id="prof-pass"><?= $password ?></p>
                </div>
                <div class="info-item">
                    <form action="vendor/photoChange.php" method="post" enctype="multipart/form-data">
                        <label for="prof-photo_change"></label><input name="foto" type="file" class="form-control" id="prof-photo_change"><br>
                        <button type="submit" class="btn btn-outline-primary">Изменить фотографию</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>