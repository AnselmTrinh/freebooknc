<?php
require_once('db_connect.php');

// Récupérer les annonces de livres depuis la base de données
$query = "SELECT * FROM books";
$result = $conn->query($query);

// Vérifier s'il y a des livres
if ($result->num_rows > 0) {
    // Afficher les annonces de livres
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>Auteur : " . $row['author'] . "</p>";
        echo "<p>Description : " . $row['description'] . "</p>";
        echo "<p>Date de publication : " . $row['publication_date'] . "</p>";
        echo "</div>";
    }
} else {
    echo "Aucun livre trouvé.";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ma Navbar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 60px; /* Ajouter un espace pour la barre de navigation fixe */
      background-color: #f1f5f8;
    }
    .card {
      width: 180px;
    }
    .card-img-top {
      height: 250px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Mon Site</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="register.php">Accès membre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connection.php">InScRiPtIoN</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Menu de livre -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card">
          <img src="img/one-piece-manga.jpg" class="card-img-top" alt="Livre 1">
          <div class="card-body">
            <h5 class="card-title">ONE PIECE</h5>
            <p class="card-text">-- MANGA --</p>
            <a href="#" class="btn btn-primary">En savoir plus</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <img src="img\Le-Petit-Prince.jpg" class="card-img-top" alt="Livre 2">
          <div class="card-body">
            <h5 class="card-title">LE PETIT PRINCE</h5>
            <p class="card-text">-- Conte --</p>
            <a href="#" class="btn btn-primary">En savoir plus</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <img src="img\brousseenfolie1pp_28022003.jpg" class="card-img-top" alt="Livre 3">
          <div class="card-body">
            <h5 class="card-title">BROUSSE EN FOLIE</h5>
            <p class="card-text">-- BANDE DESSINEE --</p>
            <a href="#" class="btn btn-primary">En savoir plus</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card">
          <img src="img\avar-moliere.jpg" class="card-img-top" alt="Livre 4">
          <div class="card-body">
            <h5 class="card-title">L'AVARE</h5>
            <p class="card-text">-- Comédie litéraire --</p>
            <a href="#" class="btn btn-primary">En savoir plus</a>
          </div>
        </div>
      </div>
      <!-- Ajoutez plus de cartes de livre ici -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <footer class="bg-dark text-white text-center py-3">
  <div class="container">
    <p>&copy; 2023 Free Book NC. Tous droits réservés.</p>
  </div>
</footer>

</body>
</html>
