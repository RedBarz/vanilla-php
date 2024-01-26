<?php
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

// Assurez-vous que la session est démarrée
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit();
}

// Incluez le fichier de connexion à la base de données
include('../../assets/php/middleware/connect.php');

// Traitez le formulaire d'ajout de rendez-vous ici (à compléter selon vos besoins)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date_heure'];
    $heure = $_POST['heure'];
    $motif = $_POST['motif'];

    // Combine la date et l'heure pour créer le champ date_heure
    $date_heure = "$date $heure";

    // Utilisez ces informations pour insérer un nouveau rendez-vous dans la base de données
    $sql = "INSERT INTO rendez_vous (utilisateur_id, date_heure, motif, heure) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['id_utilisateur'], $date_heure, $motif, $heure]);

    // Redirigez l'utilisateur vers la page de ses rendez-vous après l'ajout
    header("Location: mes_rendez_vous.php");
    exit();
}

// Générer les tranches horaires disponibles
$tranchesHoraires = genererTranchesHoraires();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Rendez-vous</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
</head>

<body>

    <h2>Ajouter un Rendez-vous :</h2>

    <form action="ajouter_rendez_vous.php" method="post">
        <label for="date_heure">Date :</label>
        <input type="date" id="date_heure" name="date_heure" required><br>

        <label for="heure">Heure :</label>
        <select name="heure" required>
            <?php foreach ($tranchesHoraires as $heure) : ?>
                <option value="<?= $heure ?>"><?= $heure ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="motif">Motif :</label>
        <input type="text" id="motif" name="motif" required><br>

        <input type="submit" value="Ajouter Rendez-vous">
    </form>

</body>

</html>
