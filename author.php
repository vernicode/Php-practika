<?php
    session_start();
    
    require_once 'config/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
    <div class="container container-box-flx">
            <?php
                $author_id = $_GET['id'];
                $paints = mysqli_query($connect, "SELECT 
                * FROM `authors_paintings` AS `pa`, `paintings`, `authors`
                WHERE
                    `paintings`.`id_p` = `pa`.`id_p` AND
                    `authors`.`id_a` = `pa`.`id_a` AND
                    `authors`.`id_a` = $author_id
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

    <?php
        require_once 'footer.php';
    ?>
</body>
</html>