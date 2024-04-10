<?php

$idToDelete = isset($_POST['id_article']) ? intval($_POST['id_article']) : 0;

    // Récupérer le nom de l'article et le nom de fichier de la photo
    $sqlSelect = "SELECT nom_article, photo_article FROM article WHERE id_article = :id_article";
    $stmtSelect = $pdo->prepare($sqlSelect);
    $stmtSelect->execute(['id_article' => $idToDelete]);
    $articleInfo = $stmtSelect->fetch(PDO::FETCH_ASSOC);


    if ($idToDelete > 0 && $articleInfo) {
        // Exécution de la suppression
        $sqlDelete = "DELETE FROM article WHERE id_article = :id_article";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $result = $stmtDelete->execute(['id_article' => $idToDelete]);

        if ($result) {
            // Supprimer le fichier de la photo du répertoire si le nom de fichier est présent
            $photoPath = '/var/www/html/Photographie/article/' . $articleInfo['photo_article'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
            $delete_message = "<p>L'article " . htmlspecialchars($articleInfo['nom_article']) . " a été supprimé avec succès.</p>";
        } else {
            $error = "<p>Erreur lors de la suppression de l'article " . htmlspecialchars($articleInfo['nom_article']) . ".</p>";
        }
    } else {
        $error = "<p>ID invalide pour la suppression ou article introuvable.</p>";
    }

    ?>