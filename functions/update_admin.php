<?php

// Traiter le second formulaire MODIFICATION ADMINISTRATEUR
$id = isset($_POST['id_user']) ? intval($_POST['id_user']) : 0;
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
$prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$error2 = '';

//MODIFIER UN ADMINISTRATEUR
// Validation des données
if (empty($username) || empty($nom) || empty($prenom) || empty($email)) {
    $error2 = 'Tous les champs doivent être remplis.';
} else {

    // Autres validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error2 = 'Format d\'email invalide.';
    }

    if (strlen($username) < 3 || strlen($username) > 20) {
        // Validation : Longueur du nom d'utilisateur
        $erro2r = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
    }

    if (strlen($nom) < 3 || strlen($nom) > 20) {
        // Validation : Longueur du nom d'utilisateur
        $error2 = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
    }
}

if (empty($error2)) {
    // Mise à jour dans la base de données
    $sql = "UPDATE administrateur_website SET username = :username, nom = :nom, prenom = :prenom, email = :email WHERE id_user = :id_user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_user' => $id,
        'username' => $username,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ]);

    if (!$stmt->execute([
        'id_user' => $id,
        'username' => $username,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ])) {
        // La requête a échoué
        $errorInfo = $stmt->errorInfo();
        echo "Erreur SQL: " . $errorInfo[2];
    }

    $message_update = "l'administrateur $username à été mise à jour avec succès.";
};
