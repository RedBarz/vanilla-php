<?php
include('../middleware/connect.php');
include('./utilisateurController.php');

$utilisateurController = new UtilisateurController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Hacher le mot de passe avant de l'insérer dans la base de données
    $mot_de_passe_hash = hashPassword($mot_de_passe);

    $utilisateurController->ajouterUtilisateur($nom, $prenom, $email, $mot_de_passe_hash);

    echo "Utilisateur ajouté avec succès.";
} else {
    echo "Méthode de requête incorrecte.";
}

header("Location: ../../../pages/index.php");
exit();

?>
