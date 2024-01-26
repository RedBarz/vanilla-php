<?php
include('../../assets/php/middleware/connect.php');
include('../../assets/php/controllers/utilisateurController.php');

$utilisateurController = new UtilisateurController($conn);

// Traitement de la suppression d'utilisateur
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];
    $utilisateurController->supprimerUtilisateur($id_utilisateur);
}

$utilisateurs = $utilisateurController->listerUtilisateurs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
    <script defer src="../../assets/js/main.js"></script>
</head>
<body>

<h2>Liste des utilisateurs :</h2>

<ul>
    <?php foreach ($utilisateurs as $utilisateur): ?>
        <li>
            <?= $utilisateur['prenom'] ?> <?= $utilisateur['nom'] ?> (<?= $utilisateur['email'] ?>)
            <!-- Ajouter un lien de modification avec l'ID de l'utilisateur -->
            <a href="modifier_utilisateur.php?id=<?= $utilisateur['id'] ?>">Modifier</a>
            <!-- Ajouter un lien de suppression avec l'ID de l'utilisateur -->
            <a href="?action=supprimer&id=<?= $utilisateur['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
