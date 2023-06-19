<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Supprimer le livre de la base de données
    $query = "DELETE FROM books WHERE title = '$book_id'";
    if ($conn->query($query) === TRUE) {
        // Rediriger vers la page des livres après la suppression
        header("Location: books.php");
        exit;
    } else {
        // En cas d'erreur lors de la suppression du livre
        $error_message = "Erreur lors de la suppression du livre. Veuillez réessayer.";
    }
}
?>
