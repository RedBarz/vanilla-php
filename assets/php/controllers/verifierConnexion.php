<?php
// Fonction de vérification de connexion par email (à adapter)
function verifierConnexion($email, $mot_de_passe, $conn) {
    // Utiliser une requête préparée pour éviter les injections SQL
    $requete = $conn->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();

    // Récupérer l'utilisateur correspondant à l'adresse e-mail
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        // Connexion réussie, définir l'ID de l'utilisateur dans la session
        session_start();
        $_SESSION['id_utilisateur'] = $utilisateur['id'];
        return true;
    } else {
        return false; // Adresse e-mail ou mot de passe incorrect
    }
}

