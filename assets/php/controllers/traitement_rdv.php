<?php
include('../middleware/connect.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $utilisateur_id = $_POST['utilisateur_id']; // Supposons que tu aies un champ caché avec l'ID de l'utilisateur
    $date_heure = $_POST['date_heure'];
    $motif = $_POST['motif'];

    // Valider et formater la date et l'heure selon le besoin
    // ...

    // Insérer le rendez-vous dans la table des rendez-vous
    $sql = "INSERT INTO rendez_vous (utilisateur_id, date_heure, motif) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$utilisateur_id, $date_heure, $motif]);

    // Rediriger ou afficher un message de succès
    header("Location: confirmation_rdv.php");
    exit();
} else {
    // Le formulaire n'a pas été soumis correctement, gestion d'erreur
    echo "Erreur : Le formulaire n'a pas été soumis correctement.";
    exit();
}
