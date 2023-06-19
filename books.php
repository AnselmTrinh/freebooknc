<!-- books.php -->
<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

require_once('db_connect.php');

// Récupérer tous les livres de la base de données
$query = "SELECT * FROM books";
$result = $conn->query($query);

$books = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Livres</h1>

        <!-- Affichage des livres -->
        <?php if (!empty($books)) : ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td><?php echo $book['author']; ?></td>
                            <td><?php echo $book['title']; ?></td>
                            <td><?php echo $book['description']; ?></td>
                            <td>
                                <!-- Lien de suppression -->
                                <a href="delete_book.php?id=<?php echo $book['title']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Aucun livre trouvé.</p>
        <?php endif; ?>

        <!-- Formulaire d'ajout de livre -->
        <h2 class="mt-4">Ajouter un livre</h2>
        <form action="add_book.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <!-- Bouton de déconnexion -->
    <a href="logout.php" class="btn btn-danger mb-4">Déconnexion</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
