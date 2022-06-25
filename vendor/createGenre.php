<?php
    require_once '../config/db.php';

    $name = $_POST['name'];
    $description = $_POST['description'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    mysqli_query($connect, "INSERT INTO `genres` (`id_g`, `name`, `description`, `photo`) VALUES (NULL, '$name', '$description', '$photo')");
    header('Location: /admin-panel.php');

?>