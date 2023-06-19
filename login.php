<!-- Page de gestion des livres pour les membres (books.php) -->
<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Rediriger l'utilisateur s'il n'est pas connecté
    header("Location: login.php");
    exit;
}

require_once('db_connect.php');

// Récupérer la liste des livres
$query = "SELECT * FROM books";
$result = $conn->query($query);

// Traitement des formulaires de modification et d'ajout de livre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_book'])) {
        // Traitement de la modification de livre
        $book_id = $_POST['book_id'];
        $new_title = $_POST['title'];
        $new_description = $_POST['description'];

        // Mettre à jour les détails du livre dans la base de données
        $update_query = "UPDATE books SET title = '$new_title', description = '$new_description' WHERE id = $book_id";
        $conn->query($update_query);

        // Rediriger vers la page de gestion des livres
        header("Location: books.php");
        exit;
    } elseif (isset($_POST['add_book'])) {
        // Traitement de l'ajout de livre
        $new_title = $_POST['title'];
        $new_description = $_POST['description'];

        // Insérer le nouveau livre dans la base de données
        $insert_query = "INSERT INTO books (title, description) VALUES ('$new_title', '$new_description')";
        $conn->query($insert_query);

        // Rediriger vers la page de gestion des livres
        header("Location: books.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gestion des livres</h1>
        <a href="logout.php" class="btn btn-primary mt-3">Se déconnecter</a>
        <hr>
        <h2>Liste des livres</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Modifier</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Supprimer</button>
                    </td>
                </tr>
                <!-- Modal de modification de livre -->
                <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Modifier le livre</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                    <div class="mb-3">
                                        <label for="editTitle" class="form-label">Titre</label>
                                        <input type="text" class="form-control" id="editTitle" name="title" value="<?php echo $row['title']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="editDescription" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="edit_book">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal de suppression de livre -->
                <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Supprimer le livre</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer ce livre ?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="" method="POST">
                                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger" name="delete_book">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
        <hr>
        <h2>Ajouter un livre</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="newTitle" class="form-label">Titre</label>
                <input type="text" class="form-control" id="newTitle" name="title" required>
            </div>
            <div class="mb-3">
                <label for="newDescription" class="form-label">Description</label>
                <textarea class="form-control" id="newDescription" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add_book">Ajouter le livre</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
