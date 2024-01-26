<?php
session_start();
include('../../assets/php/middleware/connect.php');

function genererTranchesHoraires() {
    $tranches = array();
    $heureDebut = strtotime('09:00');
    $heureFin = strtotime('18:00');

    while ($heureDebut < $heureFin) {
        $tranches[] = date('H:i', $heureDebut);
        $heureDebut = strtotime('+30 minutes', $heureDebut);
    }

    return $tranches;
}

if (!isset($_SESSION['id_utilisateur'])) {
    echo "Vous n'êtes pas connecté.";
} else {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
        $id_rdv_a_modifier = $_POST['id_rdv'];
        $nouvelle_date_heure = $_POST['nouvelle_date_heure'];
        $nouveau_motif = $_POST['nouveau_motif'];

        $sql_modifier = "UPDATE rendez_vous SET date_heure = ?, motif = ? WHERE id = ? AND utilisateur_id = ?";
        $stmt_modifier = $conn->prepare($sql_modifier);
        $stmt_modifier->execute([$nouvelle_date_heure, $nouveau_motif, $id_rdv_a_modifier, $id_utilisateur]);

        header("Location: mes_rendez_vous.php");
        exit();
    }

    if (isset($_GET['id'])) {
        $id_rdv = $_GET['id'];

        $sql_details_rdv = "SELECT id, date_heure, motif FROM rendez_vous WHERE id = ? AND utilisateur_id = ?";
        $stmt_details_rdv = $conn->prepare($sql_details_rdv);
        $stmt_details_rdv->execute([$id_rdv, $id_utilisateur]);
        $rdv_details = $stmt_details_rdv->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Rendez-vous</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="../index.php">Accueil</a></li>
            <li><a href="./crud/inscription.php">Ajouter un utilisateur</a></li>
            <li><a href="./crud/login.php">Connexion</a></li>
            <li><a href="../crud/liste_utilisateurs.php">Lister les utilisateurs</a></li>
            <li><a href="./ajouter_rendez_vous.php">Prendre rdv</a></li>
        </ul>
    </nav>

    <h2>Modifier un Rendez-vous :</h2>

    <?php if (isset($rdv_details)) : ?>
        <form action="modifier_rendez_vous.php" method="post">
            <input type="hidden" name="id_rdv" value="<?= $rdv_details['id'] ?>">
            
            <label for="nouvelle_date_heure">Nouvelle Date et Heure :</label>
            <input type="date" id="nouvelle_date_heure" name="nouvelle_date_heure" value="<?= date('Y-m-d', strtotime($rdv_details['date_heure'])) ?>" required>
            <select name="heure" required>
                <?php foreach (genererTranchesHoraires() as $heure) : ?>
                    <option value="<?= $heure ?>"><?= $heure ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="nouveau_motif">Nouveau Motif :</label>
            <input type="text" id="nouveau_motif" name="nouveau_motif" value="<?= $rdv_details['motif'] ?>" required><br>

            <input type="submit" value="Modifier Rendez-vous" name="modifier">
        </form>
    <?php else : ?>
        <p>Le rendez-vous que vous souhaitez modifier n'existe pas ou vous n'avez pas les autorisations nécessaires.</p>
    <?php endif; ?>

</body>

</html>
