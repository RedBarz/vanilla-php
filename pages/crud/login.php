<?php
// login.php

// Assure-toi d'inclure le fichier qui contient la fonction verifierConnexion
include('../../assets/php/controllers/verifierConnexion.php');

// Assure-toi que la connexion à la base de données est établie
include('../../assets/php/middleware/connect.php'); // Assure-toi que le chemin est correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier les informations de connexion
    if (verifierConnexion($email, $mot_de_passe, $conn)) {
        // Connexion réussie, rediriger vers la page des rendez-vous
        header("Location: ../rdv/mes_rendez_vous.php");
        exit();
    } else {
        // Connexion échouée, afficher un message d'erreur
        $message_erreur = "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
</head>

<body>

    <h2>Connexion</h2>

    <?php if (isset($message_erreur)) : ?>
        <p style="color: red;"><?= $message_erreur ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

        <input type="submit" value="Se connecter">
    </form>

    <p>Vous n'avez pas de compte ? <a href="./inscription.php">Inscrivez-vous ici</a>.</p>

</body>

</html>