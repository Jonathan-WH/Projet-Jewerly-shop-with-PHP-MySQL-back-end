<?php
// Traiter le second formulaire MODIFICATION ADMINISTRATEUR
$id_createur = isset($_POST['id_createur']) ? intval($_POST['id_createur']) : 0;
$createur = isset($_POST['nom_createur']) ? trim($_POST['nom_createur']) : '';
$website = isset($_POST['website']) ? trim($_POST['website']) : '';
$error2 = '';

//MODIFIER UN ADMINISTRATEUR
// Validation des données
if (empty($createur) || empty($website)) {
    $error2 = 'Tous les champs doivent être remplis.(update)';
} else {

    // Autres validation


    if (strlen($createur) < 3 || strlen($createur) > 25) {
        // Validation : Longueur du nom d'utilisateur
        $error2 = "Le nom du créateur doit contenir entre 3 et 25 caractères.";
    }

    if (strlen($website) < 10 || strlen($website) > 30) {
        // Validation : Longueur du nom d'utilisateur
        $error2 = "Le website du créateur doit contenir entre 10 et 30 caractères.";
    }
}

if (empty($error2)) {
    // Mise à jour dans la base de données
    $sql = "UPDATE createur SET nom_createur = :nom_createur, website = :website WHERE id_createur = :id_createur";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_createur' => $id_createur,
        'nom_createur' => $createur,
        'website' => $website,

    ]);

    if (!$stmt->execute([
        'id_createur' => $id_createur,
        'nom_createur' => $createur,
        'website' => $website,

    ])) {
        // La requête a échoué
        $errorInfo = $stmt->errorInfo();
        echo "Erreur SQL: " . $errorInfo[2];
    }


    $message_update = "Le créateur $createur à été mise à jour avec succès.";
};
