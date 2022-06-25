<?php
    session_start();

    if(!$_SESSION['admin']) {
        header('Location: /authorize.php');
    }

    require_once 'config/db.php';

    $paintings_select = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `paintings`"));
    $genres_select = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `genres`"));
    $authors_select = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `authors`"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .container-flx {
            display: flex;
            flex-direction: column;
        }
        .form-add {
            width: 40%;
        }
        .cntr {
            width: 50px;
        }
        .hr-shadow {
            box-shadow: 0px 2px 6px 1px #333;
        }
        .link-href {
            color: white
        }
        .link-href:hover {
            color: lightgray
        }
    </style>
</head>
<body>
    <?php
        require_once 'header.php';
    ?>
    <div class="container container-flx">
        <br>
        <h2 style="
                            font-weight: bold;
                            text-align: center;"
                            >Панель Администратора</h2>
                            <hr class="hr-shadow">

        <!-------------------------------------------------->
        
        <br>
        <h2>Добавить картину в список</h2>
        <hr>
        
        <!-------------------------------------------------->

        <div class="form-add">
            <form action="vendor/createPaint.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="input1" class="col-sm-2 col-form-label">Название</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" id="input1">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="input2" class="col-sm-2 col-form-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="input2" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input name="date" type="date" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input name="photo" type="file" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

        <!-------------------------------------------------->
        
        <br><br>
        <h2>Добавить Автора в список</h2>
        <hr>
        
        <!-------------------------------------------------->

        <div class="form-add">
            <form action="vendor/createAuthor.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Фамилия</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="surname" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <label class="col-sm-2 col-form-label">Родился</label>
                        <input name="birth_date" type="date" class="form-control">
                        <label class="col-sm-2 col-form-label">Умер</label>
                        <input name="death_date" type="date" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input name="photo" type="file" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

        <!-------------------------------------------------->
        
        <br><br>
        <h2>Добавить жанр в список</h2>
        <hr>
        
        <!-------------------------------------------------->

        <div class="form-add">
            <form action="vendor/createGenre.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Название</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea name="description" style="max-height: 200px" type="text" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input name="photo" type="file" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
        <!-------------------------------------------------->
        <br><br>
                            <h1 style="
                            font-weight: bold;
                            text-align: center;"
                            >Привязка</h1>
                            <hr class="hr-shadow">
            <h2>Картины и Жанры</h2>
            <hr>
            
        <!-------------------------------------------------->
        <form action="vendor/linkPaintGenre.php" method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Картина</label>
                <div class="col-sm-10">
                <div class="form-floating">
                    <select name="painting" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected></option>
                            <?php
                                foreach($paintings_select as $painting) {
                                ?>
                                    <option value="<?= $painting[0] ?>"><?= $painting[1] ?></option>
                                <?php
                                }
                            ?>
                        </select>
                        <label for="floatingSelect">Картина</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Жанр</label>
                <div class="col-sm-10">
                    <div class="form-floating">
                        <select name="genre" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected></option>
                            <?php
                                foreach($genres_select as $genre) {
                                ?>
                                    <option value="<?= $genre[0] ?>"><?= $genre[1] ?></option>
                                <?php
                                }
                                ?>
                        </select>
                        <label for="floatingSelect">Жанр</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

        <!-------------------------------------------------->
        
        <br><br>
        <h2>Авторы и Жанры</h2>
        <hr>
        
        <!-------------------------------------------------->
        
        <form action="vendor/linkAuthorGenre.php" method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Автор</label>
                <div class="col-sm-10">
                <div class="form-floating">
                    <select name="author" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected></option>
                            <?php
                                foreach($authors_select as $author) {
                                ?>
                                    <option value="<?= $author[0] ?>"><?= $author[1] . ' ' . $author[2] ?></option>
                                <?php
                                }
                            ?>
                        </select>
                        <label for="floatingSelect">Автор</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Жанр</label>
                <div class="col-sm-10">
                    <div class="form-floating">
                        <select name="genre" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected></option>
                            <?php
                                foreach($genres_select as $genre) {
                                ?>
                                    <option value="<?= $genre[0] ?>"><?= $genre[1] ?></option>
                                <?php
                                }
                                ?>
                        </select>
                        <label for="floatingSelect">Жанр</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

        <!-------------------------------------------------->
        
        <br><br>
        <h2>Авторы и Картины</h2>
        <hr>
        
        <!-------------------------------------------------->
        
        <form action="vendor/linkAuthorPaint.php" method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Автор</label>
                <div class="col-sm-10">
                <div class="form-floating">
                    <select name="author" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected></option>
                            <?php
                                foreach($authors_select as $author) {
                                ?>
                                    <option value="<?= $author[0] ?>"><?= $author[1] . ' ' . $author[2] ?></option>
                                <?php
                                }
                            ?>
                        </select>
                        <label for="floatingSelect">Автор</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Картина</label>
                <div class="col-sm-10">
                    <div class="form-floating">
                        <select name="painting" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected></option>
                            <?php
                                foreach($paintings_select as $paint) {
                                ?>
                                    <option value="<?= $paint[0] ?>"><?= $paint[1] ?></option>
                                <?php
                                }
                                ?>
                        </select>
                        <label for="floatingSelect">Картина</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

        <!-------------------------------------------------->
        <br><br>
                            <h1 style="
                            font-weight: bold;
                            text-align: center;"
                            >Списки</h1>
                            <hr class="hr-shadow">
            <h2>Картины</h2>
            <hr>
            
        <!-------------------------------------------------->
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Дата написания</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $paints = mysqli_query($connect, "SELECT * FROM `paintings`");
                $paints = mysqli_fetch_all($paints);
                                
                foreach ($paints as $paint) {
                    $painting_id = $paint[0];
                    $painting_name = $paint[1];
                    $painting_description = $paint[2];
                    $painting_date = $paint[3];
                    $painting_photo = $paint[4];
                ?>
                <tr>
                    <th scope="row"><?= $painting_id ?></th>
                    <td><a class="link-href" href="/paintings.php?id=<?= $painting_id ?>"><?= $painting_name ?></a></td>
                    <td><?= $painting_description ?></td>
                    <td><?= $painting_date ?></td>
                    <td>
                        <?php $show_img = base64_encode($painting_photo)?>
                        <img src="data:image/jpeg;base64, <?php echo $show_img ?>" class='cntr'>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-------------------------------------------------->
        
        <br><br>
        <h2>Авторы</h2>
        <hr>
        
        <!-------------------------------------------------->
        
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Дата рождения</th>
                    <th scope="col">Дата смерти</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $authors = mysqli_query($connect, "SELECT * FROM `authors`");
                $authors = mysqli_fetch_all($authors);
                // print_r($categories);
                foreach ($authors as $author) {
                    $author_id = $author[0];
                    $author_name = $author[1];
                    $author_surname = $author[2];
                    $author_birthdate = $author[3];
                    $author_deathdate = $author[4];
                    $author_photo = $author[5];
                ?>
                <tr>
                    <th scope="row"><?= $author_id ?></th>
                    <td><a class="link-href" href="/authors.php?id=<?= $author_id ?>"><?= $author_name . ' ' . $surname ?></a></td>
                    <td><?= $author_birthdate ?></td>
                    <td><?= $author_deathdate ?></td>
                    <td>
                        <?php $show_img = base64_encode($author_photo)?>
                        <img src="data:image/jpeg;base64, <?php echo $show_img ?>" class='cntr'>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-------------------------------------------------->
        
        <br><br>
        <h2>Жанры</h2>
        <hr>
        
        <!-------------------------------------------------->
        
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $genres = mysqli_query($connect, "SELECT * FROM `genres`");
                    $genres = mysqli_fetch_all($genres);
                    // print_r($categories);
                    foreach ($genres as $genre) {
                        $genre_id = $genre[0];
                        $genre_name = $genre[1];
                        $genre_description = $genre[2];
                        $genre_description = substr($genre_description, 0, 200) . '...';
                ?>
                <tr>
                    <th scope="row"><?= $genre_id ?></th>
                    <td><a class="link-href" href="/genres.php?id=<?= $genre_id ?>"><?= $genre_name ?></a></td>
                    <td><?= $genre_description ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <?php
        require_once 'footer.php';
    ?>
</body>
</html>