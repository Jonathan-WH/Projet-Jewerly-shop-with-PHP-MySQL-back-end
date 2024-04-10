<?php

//AJOUTER NOUVEL ADMINISTRATEUR
$username = trim($_POST['username']) ?? '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$error = '';

// Validation des données
if (empty($username) || empty($password) || empty($nom) || empty($prenom) || empty($email)) {
    $error = 'Tous les champs doivent être remplis.';
} else {
    
    // Autres validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format d\'email invalide.';
    }

    if (strlen($username) < 3 || strlen($username) > 20) {
        // Validation : Longueur du nom d'utilisateur
        $error = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
    }

      // Vérifiez si le mot de passe répond aux critères
        if (!preg_match('/[a-z]/', $password)) {
        // Pas de lettre minuscule
        $error = "Le mot de passe doit contenir au moins une lettre minuscule.";
        } 

        if (!preg_match('/[A-Z]/', $password)) {
        // Pas de lettre majuscule
        $error = "Le mot de passe doit contenir au moins une lettre majuscule.";
        } 
        if (!preg_match('/\d/', $password)) {
        // Pas de chiffre
        $error = "Le mot de passe doit contenir au moins un chiffre.";
        } 
        if (strlen($password) < 8) {
        // Longueur du mot de passe
        $error = "Le mot de passe doit contenir au moins 8 caractères.";
        }

    if (strlen($nom) < 3 || strlen($nom) > 20) {
        // Validation : Longueur du nom d'utilisateur
        $error = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
    }
    
}

if (empty($error)) {
        // Hachage du mot de passe et insertion dans la base de données
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO administrateur_website (username, password, nom, prenom, email) VALUES (:username, :password, :nom, :prenom, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $hashed_password, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email]);
        $message_new_add = "L'administrateur $nom $prenom à été créer avec succès";
        
        
    }
?>