    <!-- Fichier de connexion à la base de données (db_connect.php) -->
    <?php
$servername = "localhost"; // Remplacez par votre serveur MySQL
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "freebooknc"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Membre</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    </style>
</head>

<body>

    <div class="container">
        <!-- Formulaire de connexion -->
        <form class="form-signin mt-3" action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="loginUsername" name="loginUsername"
                    placeholder="Nom d'utilisateur" required>
                <label for="loginUsername">Nom d'utilisateur</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="loginPassword" name="loginPassword"
                    placeholder="Mot de passe" required>
                <label for="loginPassword">Mot de passe</label>
            </div>
            <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" id="rememberMeLogin" name="rememberMeLogin">
                <label class="form-check-label" for="rememberMeLogin">Se souvenir de moi</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit" name="login">Se connecter</button>
        </form>

        <!-- Lien vers la page de mot de passe oublié -->
        <div class="mt-3 text-center">
            <a href="forgot-password.php">Mot de passe oublié ?</a>
        </div>
    </div>
    <!-- Lien vers la page d'inscription -->
    <div class="mt-3 text-center">
        <a href="register.php">Je n'ai pas de compte, m'inscrire !</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    var tabs = $('.tabs');
    var selector = $('.tabs').find('a').length;
    //var selector = $(".tabs").find(".selector");
    var activeItem = tabs.find('.active');
    var activeWidth = activeItem.innerWidth();
    $(".selector").css({
        "left": activeItem.position.left + "px",
        "width": activeWidth + "px"
    });

    $(".tabs").on("click", "a", function(e) {
        e.preventDefault();
        $('.tabs a').removeClass("active");
        $(this).addClass('active');
        var activeWidth = $(this).innerWidth();
        var itemPos = $(this).position();
        $(".selector").css({
            "left": itemPos.left + "px",
            "width": activeWidth + "px"
        });
    });
    </script>
</body>

</html>