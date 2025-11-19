<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion_presence_de_personnelle";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8" , $username ,$password);
    $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION);
    //  echo"connexion reussir a la base de donnee";

} catch (PDOException $e) {

    echo("echec de connexion a la base de donnees");  
}

?>