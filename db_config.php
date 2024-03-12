<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Adresse du serveur
$username = "maximeprevot_phpFormuser"; // Nom d'utilisateur de la base de données
$password = "Maxime1404"; // Mot de passe de la base de données
$dbname = "maximeprevot_PhpForm"; // Nom de la base de données

try {
    // Créer une connexion PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration supplémentaire pour afficher les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Supprimer le message de connexion réussie d'ici
    echo "connexionr reussie";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
