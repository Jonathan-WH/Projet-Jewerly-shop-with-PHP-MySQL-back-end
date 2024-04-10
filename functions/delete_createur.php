<?php

$idToDelete = isset($_POST['id_createur']) ? intval($_POST['id_createur']) : 0;

// Récupérer le nom et le prénom avant la suppression
$sqlSelect = "SELECT nom_createur FROM createur WHERE id_createur = :id_createur";
$stmtSelect = $pdo->prepare($sqlSelect);
$stmtSelect->execute(['id_createur' => $idToDelete]);
$creatInfo = $stmtSelect->fetch(PDO::FETCH_ASSOC);


if ( $idToDelete > 0) {
   // Exécution de la suppression
   $sqlDelete = "DELETE FROM createur WHERE id_createur = :id_createur";
   $stmtDelete = $pdo->prepare($sqlDelete);
   $result = $stmtDelete->execute(['id_createur' => $idToDelete]);
   
   if ($result) {
       $delete_message = "<p>L'administrateur " . htmlspecialchars($creatInfo['nom_createur']) . " " . " a été supprimé avec succès.</p>";
   } else {
       $error3 = "<p>Erreur lors de la suppression de l'administrateur " . htmlspecialchars($creatInfo['nom_createur']) . ".</p>";
   }
} else {
   $error3 = "<p>ID invalide pour la suppression ou administrateur introuvable.</p>";
}

?>