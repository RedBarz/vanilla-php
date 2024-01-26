<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vanilla";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Ajouter une fonction pour hacher les mots de passe
function hashPassword($password) {
    // Utilise password_hash pour générer un hachage sécurisé
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedPassword;
}