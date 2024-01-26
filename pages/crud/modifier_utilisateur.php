<?php
include('../../assets/php/middleware/connect.php');
include('../../assets/php/controllers/utilisateurController.php');

$utilisateurController = new UtilisateurController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_POST['id_utilisateur'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Récupérer les informations actuelles de l'utilisateur
    $utilisateur_actuel = $utilisateurController->recupererUtilisateurParId($id_utilisateur);

    // Vérifier si un nouveau mot de passe a été fourni
    if (!empty($mot_de_passe)) {
        // Hacher le nouveau mot de passe
        $mot_de_passe_hash = hashPassword($mot_de_passe);
    } else {
        // Si aucun nouveau mot de passe n'est fourni, utiliser le mot de passe actuel
        $mot_de_passe_hash = $utilisateur_actuel['mot_de_passe'];
    }

    $utilisateurController->modifierUtilisateur($id_utilisateur, $nom, $prenom, $email, $mot_de_passe_hash);
}

// Récupérer les informations de l'utilisateur à partir de l'ID passé dans l'URL
if (isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];
    $utilisateur = $utilisateurController->recupererUtilisateurParId($id_utilisateur);

    // Vérifier si l'utilisateur existe
    if ($utilisateur) {
        $nom_actuel = isset($utilisateur['nom']) ? $utilisateur['nom'] : '';
        $prenom_actuel = isset($utilisateur['prenom']) ? $utilisateur['prenom'] : '';
        $email_actuel = isset($utilisateur['email']) ? $utilisateur['email'] : '';
        // Ajouter d'autres champs selon tes besoins
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">

</head>
<body>

<form action="modifier_utilisateur.php" method="post">
    <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id'] ?>">

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom_actuel) ?>" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($prenom_actuel) ?>" required><br>

    <label for="email">E-mail :</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email_actuel) ?>" required><br>

    <label for="mot_de_passe">Nouveau mot de passe :</label>
    <input type="password" id="mot_de_passe" name="mot_de_passe"><br>

    <input type="submit" value="Modifier">
</form>

<!-- Ajouter un lien pour annuler la modification et retourner à la liste des utilisateurs -->
<a href="liste_utilisateurs.php">Annuler la modification</a>

<!-- Ajouter un bouton pour revenir à l'accueil -->
<a href="accueil.php">Retour à l'accueil</a>

</body>
</html>
<?php
    } else {
        echo "Utilisateur non trouvé.";
        exit();
    }
} else {
    echo "ID d'utilisateur non spécifié.";
    exit();
}
?>
