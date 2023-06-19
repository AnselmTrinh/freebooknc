<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freebooknc";
$port = 3306;

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Définir le jeu de caractères des résultats de la base de données
mysqli_set_charset($conn, 'utf8');
?>
