<?php
    require_once '../config/db.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
    $date = $_POST['date'];

    mysqli_query($connect, "INSERT INTO `paintings` (`id_p`, `name`, `description`, `date`, `photo`) VALUES (NULL, '$name', '$description', '$date', '$photo')");
    header('Location: /admin-panel.php');

?>