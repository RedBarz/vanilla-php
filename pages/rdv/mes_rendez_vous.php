<?php
// Assurez-vous que la session est démarrée
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // Si l'utilisateur n'est pas connecté, vous pouvez gérer cela ici (par exemple, afficher un message)
    echo "Vous n'êtes pas connecté.";
    // Vous pouvez également rediriger vers une autre page si nécessaire, mais la redirection est retirée ici
} else {
    // Incluez le fichier de connexion à la base de données
    include('../../assets/php/middleware/connect.php');

    // Récupérez l'ID de l'utilisateur à partir de la session
    $id_utilisateur = $_SESSION['id_utilisateur'];

    // Vérifiez si la requête POST pour la suppression a été soumise
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
        $id_rdv_a_supprimer = $_POST['id_rdv'];

        // Requête SQL pour supprimer le rendez-vous
        $sql_supprimer = "DELETE FROM rendez_vous WHERE id = ? AND utilisateur_id = ?";
        $stmt_supprimer = $conn->prepare($sql_supprimer);
        $stmt_supprimer->execute([$id_rdv_a_supprimer, $id_utilisateur]);

        // Vous pouvez également ajouter une redirection ou un message ici après la suppression
    }

    // Requête SQL pour récupérer les rendez-vous de l'utilisateur avec les informations de l'utilisateur
    $sql = "SELECT r.id, r.date_heure, r.heure, r.motif, u.nom, u.prenom FROM rendez_vous r
            INNER JOIN utilisateurs u ON r.utilisateur_id = u.id
            WHERE r.utilisateur_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_utilisateur]);
    $rendez_vous = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Rendez-vous</title>
    <link rel="stylesheet" href="/vanilla/assets/css/styles.css">
    <style>
        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #f2f2f2;
        }

        .btn-supprimer {
            background-color: #ff0000;
            color: #ffffff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .btn-modifier {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #f00;
            /* Couleur du bouton, à personnaliser */
            color: #fff;
            /* Couleur du texte, à personnaliser */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
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

    <?php if (isset($rendez_vous)) : ?>
        <h2>Mes Rendez-vous à venir :</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date et Heure</th>
                        <th>Motif</th>
                        <th>Nom de l'utilisateur</th>
                        <th>Prénom de l'utilisateur</th>
                        <th>Heure</th>
                        <th>Actions</th> <!-- Ajout de la colonne Actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rendez_vous as $rdv) : ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($rdv['date_heure'])) ?></td>
                            <td><?= $rdv['motif'] ?></td>
                            <td><?= $rdv['nom'] ?></td>
                            <td><?= $rdv['prenom'] ?></td>
                            <td><?= $rdv['heure'] ?></td>
                            <td>
                                <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous?');">
                                    <input type="hidden" name="id_rdv" value="<?= $rdv['id'] ?>">
                                    <button type="submit" class="btn-supprimer" name="supprimer">Supprimer</button>
                                </form>
                                <a href="modifier_rendez_vous.php?id=<?= $rdv['id'] ?>" class="btn-modifier">Modifier</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>


</body>

</html>