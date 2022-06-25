<?php
    require_once '../config/db.php';

    $author_id = $_POST['author'];
    $paint_id = $_POST['painting'];

    mysqli_query($connect, "INSERT INTO `authors_paintings` (`id_a`, `id_p`) VALUES ($author_id, $paint_id)");
    
    header('Location: /admin-panel.php');
?>