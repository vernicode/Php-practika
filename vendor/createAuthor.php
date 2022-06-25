<?php
    require_once '../config/db.php';

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $birth_date = $_POST['birth_date'];
    $death_date = $_POST['death_date'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    mysqli_query($connect, "INSERT INTO `authors` (`id_a`, `name`, `surname`, `birth_date`, `death_date`, `photo`) VALUES (NULL, '$name', '$surname', '$birth_date', '$death_date', '$photo')");
    header('Location: /admin-panel.php');
?>