<!-- Page d'inscription (register.php) -->
<?php
session_start();

if (isset($_SESSION['user'])) {
    // Rediriger l'utilisateur s'il est déjà connecté
    header("Location: books.php");
    exit;
}

require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['registerUsername'];
    $password = $_POST['registerPassword'];

    // Vérification des données (vous pouvez ajouter vos propres validations ici)

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion de l'utilisateur dans la base de données
    $query = "INSERT INTO member (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($query) === TRUE) {
        // Récupérer l'ID de l'utilisateur nouvellement créé
        $user_id = $conn->insert_id;

        // Établir une session pour l'utilisateur nouvellement inscrit
        $_SESSION['user'] = $user_id;

        // Redirection vers la page de gestion des livres
        header("Location: books.php");
        exit;
    } else {
        // En cas d'erreur lors de l'insertion de l'utilisateur dans la base de données
        $error_message = "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}

// Gestion de la déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="form-signin" action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Accès membre</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="registerUsername" name="registerUsername" placeholder="Nom d'utilisateur" required>
                <label for="registerUsername">Nom d'utilisateur</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Mot de passe" required>
                <label for="registerPassword">Mot de passe</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="register">S'inscrire</button>
        </form>
        
        <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
