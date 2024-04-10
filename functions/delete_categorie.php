<?php
$idToDelete = isset($_POST['id_categorie']) ? intval($_POST['id_categorie']) : 0;

// Récupérer le nom et le prénom avant la suppression
$sqlSelect = "SELECT nom_categorie FROM categorie WHERE id_categorie = :id_categorie";
$stmtSelect = $pdo->prepare($sqlSelect);
$stmtSelect->execute(['id_categorie' => $idToDelete]);
$catInfo = $stmtSelect->fetch(PDO::FETCH_ASSOC);


if ($idToDelete > 0) {
    // Exécution de la suppression
    $sqlDelete = "DELETE FROM categorie WHERE id_categorie = :id_categorie";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $result = $stmtDelete->execute(['id_categorie' => $idToDelete]);

    if ($result) {
        $delete_message = "<p>La catégorie " . htmlspecialchars($catInfo['nom_categorie']) . " " . " a été supprimé avec succès.</p>";
    } else {
        $error3 = "<p>Erreur lors de la suppression de l'administrateur " . htmlspecialchars($catInfo['nom_categorie']) . ".</p>";
    }
} else {
    $error3 = "<p>ID invalide pour la suppression ou catégorie introuvable.</p>";
}
?>