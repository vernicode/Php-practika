<?php
    require_once '../config/db.php';

    $painting_id = $_POST['painting'];
    $genre_id = $_POST['genre'];

    mysqli_query($connect, "INSERT INTO `paintings_genres` (`id_p`, `id_g`) VALUES ($painting_id, $genre_id)");
    
    header('Location: /admin-panel.php');
?>