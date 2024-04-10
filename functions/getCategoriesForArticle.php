<?php
function getCategoriesForArticle($pdo, $idArticle) {
    $stmt = $pdo->prepare("SELECT c.nom_categorie FROM categorie c JOIN article_categorie ac ON c.id_categorie = ac.ref_categorie WHERE ac.ref_article = :idArticle");
    $stmt->execute(['idArticle' => $idArticle]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
