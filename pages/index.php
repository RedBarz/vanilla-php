<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
    <script defer src="../assets/js/main.js"></script>

</head>

<body>
    <?php
    include('../assets/php/middleware/connect.php');

    // Assurez-vous que la session est démarrée
    session_start();

    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['id_utilisateur'])) {
        // Si l'utilisateur est connecté, récupérez son nom (à adapter selon votre structure de base de données)
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $sql = "SELECT nom, prenom FROM utilisateurs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_utilisateur]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Affichez le profil de l'utilisateur
        echo '<div class="user-profile">';
        echo '<img src="chemin_vers_la_photo.jpg" alt="Photo de profil">';
        echo '<p>' . $utilisateur['prenom'] . ' ' . $utilisateur['nom'] . '</p>';
        echo '<button class="logout-button" onclick="window.location.href=\'./crud/deconnexion.php\'">Déconnexion</button>';
        echo '</div>';
    }
    ?>

    <nav>
        <ul>
            <li><a href="./crud/inscription.php">Ajouter un utilisateur</a></li>
            <li><a href="./crud/login.php">Connexion</a></li>
            <li><a href="./crud/liste_utilisateurs.php">Lister les utilisateurs</a></li>
            <li><a href="./rdv/mes_rendez_vous.php">rendez-vous</a></li>
        </ul>
    </nav>

</body>

</html>