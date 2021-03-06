<?php
    session_start();
    
    require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style>
        .container-block {
            margin-top: 10px;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #d9e6fb 100%);
        }
        .card {
            border: 0
        }
        .container-flx {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
        }
        .container-box-flx {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .no-underline {
            text-decoration: none
        }
        .author-photo {
            width: 40px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php
        require_once 'header.php';
    ?>
    <br>
    <div class="container container-flx">
    <h2>Картины</h2>
    <br>
        <div class="container-box-flx">
            <?php
                $paints = mysqli_query($connect, "SELECT 
                * FROM `authors_paintings` AS `pa`, `paintings`, `authors`
                WHERE
                    `paintings`.`id_p` = `pa`.`id_p` AND
                    `authors`.`id_a` = `pa`.`id_a`
                    GROUP BY `paintings`.`id_p`
                ");
                $paints = mysqli_fetch_all($paints);
                foreach($paints as $paint) {
                    $paint_id = $paint[2];
                    $paint_author_id = $paint[7];
                    $paint_name = $paint[3];
                    $paint_desc = $paint[4];
                    $paint_date = $paint[5];
                    $paint_photo = $paint[6];
                    $paint_author_name = $paint[8];
                    $paint_author_surname = $paint[9];
                    $paint_author_photo = $paint[12];
            ?>
                <div class="card" style="width: 18rem;">
                <?php $show_img = base64_encode($paint_photo)?>
                    <a href="/painting.php?id=<?= $paint_id ?>"><img class="card-img-top" src="data:image/jpeg;base64, <?php echo $show_img ?>"></a>
                    <div class="card-title">
                        <h5>Картина: <?= $paint_name ?></h5><h6 class="card-subtitle mb-2 text-muted"><?= $paint_date ?></h6>
                        <p class="card-text">Автор: <a class="no-underline" href="/author.php?id=<?= $paint_author_id ?>"><?= $paint_author_name . ' ' . $paint_author_surname ?></a></p>
                        <?php $show_img = base64_encode($paint_author_photo)?>
                        <img class="author-photo" src="data:image/jpeg;base64, <?php echo $show_img ?>">
                    </div>
                    
                    <div class="card-body">
                        <p class="card-text"><?= $paint_desc ?></p>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        <hr>
        <h2>Жанры живописи</h2>
        <div class="container-box-flx">
        <iframe src="https://genshin-impact-map.appsample.com/location?names=anemoculus,geoculus" height="400" width="600" frameBorder="0"></iframe>
        </div>
        <div class="container-box-flx">
            <?php
                $genres = mysqli_query($connect, "SELECT * FROM `genres`");
                $genres = mysqli_fetch_all($genres);
                foreach($genres as $genre) {
                    $genre_id = $genre[0];
                    $genre_name = $genre[1];
                    $genre_desc = $genre[2];
                    $genre_photo = $genre[3];
            ?>
                <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                    <div class="col">
                        <a class="no-underline" href="/genre.php?id=<?= $genre_id ?>">
                            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg">
                                <?php $show_img = base64_encode($genre_photo)?>
                                <img style="position: absolute; " src="data:image/jpeg;base64, <?php echo $show_img ?>">
                                <div style="z-index: 999" class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold"><?= $genre_name ?></h2>
                                    <ul class="d-flex list-unstyled mt-auto">
                                        <li class="me-auto">
                                            <img style="filter: invert(1)" src="src/Logo/418815.png" width="100">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <span><h5><?= $genre_name ?></h5><?= $genre_desc ?></span>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
        require_once 'footer.php';
    ?>
</body>
</html>