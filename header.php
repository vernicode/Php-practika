<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        .text_gradient {
            /* color: linear-gradient(-225deg, #3D4E81 0%, #5753C9 48%, #6E7FF3 100%); */
            font-size: 1.5em;
            background: linear-gradient(-225deg, #20E2D7 0%, #F9FEA5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .avatar:hover {
            transform: scale(1.1);
        }
        .avatar-undef {
            border: 1px solid black;
            filter: contrast(0);
        }
        .bg-dark {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
            background-blend-mode: multiply,multiply;
        }
        .avatar {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            transition: all .2s ease-in-out;
        }
        .header-logo {
            width: 100px;
            filter: invert(1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container container-fluid">
            <a class="navbar-brand" href="/"><div class="text_gradient"><img class="header-logo" src="src/Logo/418815.png"></div></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Меню
                        </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile.php">
                                Профиль 
                                    <?php
                                    if ($_SESSION['admin']) {
                                        $profile = $_SESSION['admin'];
                                        $show_img = base64_encode($profile['photo']);
                                        if ($profile['photo']) {
                                    ?>
                                            <img src="data:image/jpeg;base64, <?php echo $show_img ?>" class='avatar'>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="src/images/icons8-no-image-50.png" class='avatar avatar-undef'>
                                    <?php
                                        }
                                    }
                                    ?>
                            </a>
                        </li>
                        <?php
                        if ($_SESSION['admin']) {
                        ?>
                            <li><a class="dropdown-item" href="/admin-panel.php">Админ панель</a></li>
                        <?php
                        }
                        ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <?php
                                if ($_SESSION['admin']) {
                            ?>
                                <a type="button" class="btn dropdown-item" href="vendor/logout.php">Выйти</a>
                                <?php
                                } else {
                                ?>
                                    <a type="button" class="btn dropdown-item" href="authorize.php">
                                        Вход
                                    </a>
                                    <a type="button" class="btn dropdown-item" href="register.php">
                                        Регистрация
                                    </a>
                                <?php
                                }
                            ?>
                        </li>
                    </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
</body>
</html>