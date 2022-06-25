<?php
    define('db_host', 'localhost');
    define('db_user', 'root');
    define('db_pasw', '');
    define('db_name', "painting_spravochnik");
    
    $connect = @new mysqli(db_host, db_user, db_pasw, db_name);
?>