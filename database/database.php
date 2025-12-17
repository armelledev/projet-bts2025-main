<?php
define("DBNAME", "gestion_presence_personnelle");
define("DBHOST", "localhost");
define("DBUSER", "postgres");
define("DBPASS", "postgres");
define("PORT", "5432");

try {
    $dcn = "pgsql:host=" . DBHOST . ";dbname=" . DBNAME . ";port=". PORT .";";
    $pdo = new PDO($dcn, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
