<?php
    require_once '../config/db.php';

    $author_id = $_POST['author'];
    $genre_id = $_POST['genre'];

    mysqli_query($connect, "INSERT INTO `authors_genres` (`id_a`, `id_g`) VALUES ($author_id, $genre_id)");
    
    header('Location: /admin-panel.php');
?>