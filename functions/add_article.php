<?php
 // Traitement de l'upload de la photo
 if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $allowed = ['jpg', 'jpeg', 'png'];
    $filename = $_FILES['photo']['name'];
    $filetmp = $_FILES['photo']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    list($width, $height) = getimagesize($filetmp);
    if ($width != $height) {
        $error .= "Le format de la photo doit être carré. ";
    }

    $basePath = '/var/www/html/Photographie/article';
    $safeFilename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $filename);
    $newpath = $basePath . '/' . $safeFilename;

    if (!move_uploaded_file($filetmp, $newpath)) {
        $error .= "Erreur lors de l'upload de la photo. ";
    }
}

// Récupération et validation des données du formulaire
$nom_article = isset($_POST['nom_article']) ? trim($_POST['nom_article']) : '';
$prix_article = isset($_POST['prix_article']) ? trim($_POST['prix_article']) : '';
$description_article = isset($_POST['description_article']) ? trim($_POST['description_article']) : '';
$ref_createur = isset($_POST['ref_createur']) ? trim($_POST['ref_createur']) : '';
$ref_categorie = isset($_POST['ref_categorie']) ? $_POST['ref_categorie'] : [];
$genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';


if (strlen($nom_article) < 3 || strlen($nom_article) > 30) {
    $error .= "Le nom de l'article doit contenir entre 3 et 30 caractères. <br> ";
}
if (!is_numeric($prix_article) || strlen($prix_article) < 3 || strlen($prix_article) > 10) {
    $error .= "Le prix de l'article doit être un nombre et contenir entre 3 et 10 chiffres. <br> ";
}
if (strlen($description_article) < 10 || strlen($description_article) > 1000) {
    $error .= "La description doit contenir entre 10 et 1000 caractères. <br> ";
}
if ($ref_createur == "") {
    $error .= "Veuillez choisir un créateur. <br> ";
}
if (empty($ref_categorie)) {
    $error .= "Veuillez choisir au moins une catégorie de type de bijoux. <br> ";
}

$jewelryTypes = $pdo->query("SELECT id_categorie, nom_categorie FROM categorie WHERE type_categorie='jewerly'")->fetchAll(PDO::FETCH_ASSOC);

// IDs des catégories correspondant aux types de bijoux
$jewelryCategoryIds = array_map(function ($type) {
    return $type['id_categorie'];
}, $jewelryTypes);

// Vérification pour s'assurer qu'au moins un type de bijou est sélectionné
$hasJewelryTypeSelected = false;
foreach ($ref_categorie as $catId) {
    if (in_array($catId, $jewelryCategoryIds)) {
        $hasJewelryTypeSelected = true;
        break;
    }
}

if (!$hasJewelryTypeSelected) {
    $error .= "Veuillez sélectionner un type de bijou. ";
}

if ($genre == "") {
    $error .= "Veuillez choisir un genre. <br> ";
}



// Insertion dans la base de données
if (empty($error)) {
    $sql = "INSERT INTO article (nom_article, prix_article, photo_article, description_article, ref_createur, genre) VALUES (:nom_article, :prix_article, :photo_article, :description_article, :ref_createur, :genre)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom_article' => $nom_article,
        'prix_article' => $prix_article,
        'photo_article' => $safeFilename,
        'description_article' => $description_article,
        'ref_createur' => $ref_createur,
        'genre' => $genre
    ]);

    $id_article = $pdo->lastInsertId();

    foreach ($ref_categorie as $catId) {
        $sql = "INSERT INTO article_categorie (ref_article, ref_categorie) VALUES (:ref_article, :ref_categorie)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ref_article' => $id_article, 'ref_categorie' => $catId]);
    }

    $message_update = "L'Article '$nom_article' à été ajouté avec succès.";
}

// TODO probleme XX
?>