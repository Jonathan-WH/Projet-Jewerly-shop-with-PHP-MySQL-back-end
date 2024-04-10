<?php 

    $servername = "db";
    $username = "root";
    $password = "root";
    $database = "ifage";
            
    // connexion au serveur
    // https://www.php.net/manual/fr/pdo.construct.php
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception   
    
?>
