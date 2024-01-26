<?php
include('../../assets/php/middleware/connect.php');
include('../../assets/php/controllers/utilisateurController.php');

$utilisateurController = new UtilisateurController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $utilisateurController->ajouterUtilisateur($nom, $prenom, $email, $mot_de_passe);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
    <script defer src="../../assets/js/main.js"></script>
</head>

<body>

    <form action="../../assets/php/controllers/traitement_inscription.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="email">E-mail :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>

        <input type="submit" value="S'inscrire">
    </form>

</body>

</html>