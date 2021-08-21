<?php 
//To Connect To Database
    $host = 'localhost';
    $dbname = 'sangdon';
    $mysql_username = 'root';
    $mysql_password = '';

//DSN: Data Source Name
    $dsn='mysql:host='.$host.';dbname='.$dbname;

//Create a PDO instant
    $pdo = new PDO($dsn,$mysql_username,$mysql_password);
//If Theres Any Errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>