<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $publication_date = $_POST['publication_date'];

    // Validation des données (vous pouvez ajouter vos propres validations ici)

    // Insérer le nouveau livre dans la base de données
    $query = "INSERT INTO books (title, author, description, publication_date) VALUES ('$title', '$author', '$description', '$publication_date')";
    if ($conn->query($query) === TRUE) {
        // Rediriger vers la page de gestion des livres après l'ajout
        header("Location: books.php");
        exit;
    } else {
        // Afficher un message d'erreur en cas d'échec de l'insertion
        $error_message = "Une erreur est survenue lors de l'ajout du livre.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="form-add-book" action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Ajouter un livre</h1>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>
            <div class="form-floating">
                <input type="text" class="form-control" id="title" name="title" placeholder="Titre" required>
                <label for="title">Titre</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="author" name="author" placeholder="Auteur" required>
                <label for="author">Auteur</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                <label for="description">Description</label>
            </div>
            <div class="form-floating">
                <input type="date" class="form-control" id="publication_date" name="publication_date" required>
                <label for="publication_date">Date de publication</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="addBook">Ajouter le livre</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
