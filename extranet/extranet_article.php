<?php
include('../functions/session.php');
include('../functions/connexion_db.php');
include('../functions/getCreateurNom.php');
include('../functions/getCategoriesForArticle.php');
include('../functions/getIdcategoriesforarticle.php');


$message_new_add = '';
$message_update = '';
$error = "";
$safeFilename = "";
$currentPhoto = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_article'])) {
    include('../functions/add_article.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_article'])) {
    include('../functions/update_article.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_article'])) {
    include('../functions/delete_article.php');
}






// Pour afficher les créateurs dans le champs createur
$createurs = $pdo->query("SELECT id_createur, nom_createur FROM createur")->fetchAll(PDO::FETCH_ASSOC);

// Pour afficher les catégorie dans le champs catégorie
$categories = $pdo->query("SELECT id_categorie, nom_categorie, type_categorie FROM categorie")->fetchAll(PDO::FETCH_ASSOC);

//afficher les catégorie par type
$metals = $pdo->query("SELECT id_categorie, nom_categorie, type_categorie FROM categorie WHERE type_categorie='metal'")->fetchAll(PDO::FETCH_ASSOC);
$stones = $pdo->query("SELECT id_categorie, nom_categorie, type_categorie FROM categorie WHERE type_categorie='stone'")->fetchAll(PDO::FETCH_ASSOC);
$jewelryTypes = $pdo->query("SELECT id_categorie, nom_categorie, type_categorie FROM categorie WHERE type_categorie='jewerly'")->fetchAll(PDO::FETCH_ASSOC);

// Paramètres pour la mise à jour
$updateTri = isset($_GET['update_tri']) ? $_GET['update_tri'] : '';
$updateCreateurId = isset($_GET['update_createur']) ? $_GET['update_createur'] : '';

// Construction de la requête SQL pour la mise à jour
$updateSql = "SELECT * FROM article";
$updateWhereConditions = [];
$updateParams = [];

// Vérifier et appliquer le filtre de créateur pour la mise à jour
if (!empty($updateCreateurId)) {
    $updateWhereConditions[] = "ref_createur = :update_createur";
    $updateParams[':update_createur'] = $updateCreateurId;
}

// Vérifier et appliquer le tri pour la mise à jour
if (!empty($_GET['update_tri'])) {
    switch ($_GET['update_tri']) {
        case 'nom_asc':
            $updateSql .= " ORDER BY nom_article ASC";
            break;
        case 'nom_desc':
            $updateSql .= " ORDER BY nom_article DESC";
            break;
        case 'prix_asc':
            $updateSql .= " ORDER BY prix_article ASC";
            break;
        case 'prix_desc':
            $updateSql .= " ORDER BY prix_article DESC";
            break;
        default:
            // Tri par défaut si aucun critère n'est sélectionné
            $updateSql .= " ORDER BY nom_article ASC";
            break;
    }
}

// Ajouter les conditions WHERE à la requête de mise à jour si nécessaire
if (!empty($updateWhereConditions)) {
    $updateSql .= " WHERE " . implode(' AND ', $updateWhereConditions);
}

$updateStmt = $pdo->prepare($updateSql);
foreach ($updateParams as $key => $value) {
    $updateStmt->bindValue($key, $value);
}
$updateStmt->execute();
$updateArticles = $updateStmt->fetchAll(PDO::FETCH_ASSOC);

// Paramètres pour la suppression
$deleteTri = isset($_GET['delete_tri']) ? $_GET['delete_tri'] : '';
$deleteCreateurId = isset($_GET['delete_createur']) ? $_GET['delete_createur'] : '';

// Construction de la requête SQL pour la suppression
$deleteSql = "SELECT * FROM article";
$deleteWhereConditions = [];
$deleteParams = [];

if (!empty($deleteCreateurId)) {
    $deleteWhereConditions[] = "ref_createur = :delete_createur";
    $deleteParams[':delete_createur'] = $deleteCreateurId;
}

// Vérifier et appliquer le tri pour la suppression
if (!empty($_GET['delete_tri'])) {
    switch ($_GET['delete_tri']) {
        case 'nom_asc':
            $deleteSql .= " ORDER BY nom_article ASC";
            break;
        case 'nom_desc':
            $deleteSql .= " ORDER BY nom_article DESC";
            break;
        case 'prix_asc':
            $deleteSql .= " ORDER BY prix_article ASC";
            break;
        case 'prix_desc':
            $deleteSql .= " ORDER BY prix_article DESC";
            break;
        default:
            // Tri par défaut si aucun critère n'est sélectionné
            $deleteSql .= " ORDER BY nom_article ASC";
            break;
    }
}

// Ajouter les conditions WHERE à la requête de suppression si nécessaire
if (!empty($deleteWhereConditions)) {
    $deleteSql .= " WHERE " . implode(' AND ', $deleteWhereConditions);
}

$deleteStmt = $pdo->prepare($deleteSql);
foreach ($deleteParams as $key => $value) {
    $deleteStmt->bindValue($key, $value);
}
$deleteStmt->execute();
$deleteArticles = $deleteStmt->fetchAll(PDO::FETCH_ASSOC);


$article = $pdo->query("SELECT * FROM article")->fetchAll(PDO::FETCH_ASSOC);


include('extranet_layout/header_extranet.php')

?>




<title>Article</title>

<?php include('extranet_layout/nav-extranet.php') ?>

<div class="content-admin">

    <h1 class="top-title">Article</h1>

    <div class="error-message">


        <?php if (!empty($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <h4><?php echo $message_update ?></h4>

        <?php if (!empty($error2)) : ?>
            <p class="error"><?php echo $error2; ?></p>
        <?php endif; ?>

        <?php if (!empty($error3)) : ?>
            <p class="error"><?php echo $error3; ?></p>
        <?php endif; ?>

        <?php if (!empty($delete_message)) : ?>
            <p class="error"><?php echo $delete_message; ?></p>
        <?php endif; ?>

        <?php if (!empty($message_new_add)) : ?>
            <p class="error"><?php echo $message_new_add; ?></p>
        <?php endif; ?>



    </div>

    <div class="add_admin">
        <h2 id="add_admin">Ajouter un article:</h2>

        <form id="form_add_article" action="extranet_article.php" method="post" enctype="multipart/form-data">

            <label for="">Nom de l'article :</label>
            <input name="nom_article" type="text">

            <label for="">Prix de l'article :</label>
            <input name="prix_article" type="number">

            <label for="">Photo :</label>
            <input name="photo" type="file">

            <input id="photo_name" type="hidden" name="photo_article" value="<?php echo $currentPhoto ? $currentPhoto : $safeFilename; ?>">

            <label for="">Description :</label>
            <textarea name="description_article" type="text"></textarea>

            <label for="">Choisir un créateur :</label>
            <select name="ref_createur" id="">
                <option value="">--Choisir un créateur--</option>
                <?php foreach ($createurs as $createur) : ?>
                    <option value="<?php echo $createur['id_createur']; ?>">
                        <?php echo $createur['nom_createur']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div id="categorie">
                <fieldset>
                    <legend>Métaux:</legend>
                    <?php foreach ($metals as $metal) : ?>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="metal_<?php echo $metal['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $metal['id_categorie']; ?>">
                            <label for="metal_<?php echo $metal['id_categorie']; ?>"><?php echo $metal['nom_categorie']; ?></label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>

                <fieldset>
                    <legend>Pierres:</legend>
                    <?php foreach ($stones as $stone) : ?>
                        <div class="custom-checkbox">
                            <input type="checkbox" id="stone_<?php echo $stone['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $stone['id_categorie']; ?>">
                            <label for="stone_<?php echo $stone['id_categorie']; ?>"><?php echo $stone['nom_categorie']; ?></label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>

                <div class="category-group">
                    <h3>Type:</h3>
                    <?php foreach ($jewelryTypes as $type) : ?>
                        <label class="custom-radio">
                            <input type="radio" id="jewelry_<?php echo $type['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $type['id_categorie']; ?>">
                            <span class="radio-mark"></span>
                            <?php echo $type['nom_categorie']; ?>
                        </label>
                    <?php endforeach; ?>
                </div>

            </div>


            <!-- Possibilité d'ajouter une catégorie -->

            <label for="">Choisir un genre:</label>
            <select name="genre" id="">
                <option value="">--Choisir un genre--</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>

            </select>

            <br>

            <button name="add_article" type="submit">Ajouter un article</button>
        </form>

    </div>

    <div class="admin_add_content">
        <h2 id="update_admin">Modifier un article</h2>
        <div id="filtreArticle">

            <form action="extranet_article.php#update_admin" method="get">
                <select name="update_tri">
                    <option value="">Tous les articles</option>
                    <option value="nom_asc" <?php echo ($updateTri == 'nom_asc') ? 'selected' : ''; ?>>Nom (A - Z)</option>
                    <option value="nom_desc" <?php echo ($updateTri == 'nom_desc') ? 'selected' : ''; ?>>Nom (Z - A)</option>
                    <option value="prix_asc" <?php echo ($updateTri == 'prix_asc') ? 'selected' : ''; ?>>Prix (croissant)</option>
                    <option value="prix_desc" <?php echo ($updateTri == 'prix_desc') ? 'selected' : ''; ?>>Prix (décroissant)</option>
                </select>
                <button type="submit">Trier</button>
            </form>
            <form action="extranet_article.php#update_admin" method="get">
                <select name="update_createur">
                    <option value="">Tous les créateurs</option>
                    <?php foreach ($createurs as $createur) : ?>
                        <option value="<?php echo $createur['id_createur']; ?>" <?php echo ($updateCreateurId == $createur['id_createur']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($createur['nom_createur']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Filtrer</button>
            </form>

        </div>


        <!-- Liste des articles -->
        <div class="update_list_article">




            <?php foreach ($updateArticles as $articles) : ?>

                <div class="article-content">
                    <img src="/Photographie/article/<?php echo $articles['photo_article']; ?>" alt="">
                    <h2><?php echo htmlspecialchars($articles['nom_article']); ?></h2>
                    <h4><?php echo htmlspecialchars($articles['prix_article']); ?> &#8364</h4>
                    <h5>By:<?php echo htmlspecialchars(getCreateurNom($createurs, $articles['ref_createur'])); ?></h5>

                    <p><?php echo htmlspecialchars($articles['description_article']); ?></p>
                    <p>Genre: <?php echo htmlspecialchars($articles['genre']); ?></p>

                    <?php
                    $categories = getCategoriesForArticle($pdo, $articles['id_article']);
                    if (!empty($categories)) {
                        echo "<p>Catégories: " . htmlspecialchars(implode(", ", $categories)) . "</p>";
                    }
                    ?>

                    <button class="admin" onclick='editArticle(<?php echo htmlspecialchars(json_encode(array(
                                                                    "id_article" => $articles["id_article"],
                                                                    "nom_article" => $articles["nom_article"],
                                                                    "prix_article" => $articles["prix_article"],
                                                                    "description_article" => $articles["description_article"],
                                                                    "ref_createur" => $articles["ref_createur"],
                                                                    "genre" => $articles["genre"],
                                                                    "categories" => getIdcategoriesforarticle($pdo, $articles["id_article"])
                                                                )), ENT_QUOTES, 'UTF-8'); ?>, this)'><i class="fa-solid fa-pen"></i> Éditer</button>





                </div>

            <?php endforeach; ?>


        </div>

        <div>
            <!-- Formulaire de modification (caché initialement) -->
            <div id="update_form_article">
                <i id="croix-update-admin" class="fa-regular fa-circle-xmark"></i>
                <h2>Modifier Article</h2>
                <form id="form_add_article" action="extranet_article.php" method="post" enctype="multipart/form-data" class="update_article">

                    <input type="hidden" id="editId" name="id_article">

                    <label for="">Nom de l'article :</label>
                    <input id="editArticle" name="nom_article" type="text">

                    <label for="">Prix de l'article :</label>
                    <input id="editPrixarticle" name="prix_article" type="number">

                    <label for="">Photo :</label>
                    <input id="editPhoto" name="photo" type="file">

                    <input id="photo_name" type="hidden" name="photo_article" value="<?php echo $currentPhoto ? $currentPhoto : $safeFilename; ?>">




                    <label for="">Description :</label>
                    <textarea id="editDescription" name="description_article" type="text"></textarea>

                    <label for="">Choisir un créateur :</label>
                    <select name="ref_createur" id="">
                        <option value="">--Choisir un créateur--</option>
                        <?php foreach ($createurs as $createur) : ?>
                            <option value="<?php echo $createur['id_createur']; ?>">
                                <?php echo $createur['nom_createur']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div id="categorie">
                        <fieldset>
                            <legend>Métaux:</legend>
                            <?php foreach ($metals as $metal) : ?>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="metal_<?php echo $metal['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $metal['id_categorie']; ?>">
                                    <label for="metal_<?php echo $metal['id_categorie']; ?>"><?php echo $metal['nom_categorie']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </fieldset>

                        <fieldset>
                            <legend>Pierres:</legend>
                            <?php foreach ($stones as $stone) : ?>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="stone_<?php echo $stone['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $stone['id_categorie']; ?>">
                                    <label for="stone_<?php echo $stone['id_categorie']; ?>"><?php echo $stone['nom_categorie']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </fieldset>

                        <div class="category-group">
                            <h3>Type:</h3>
                            <?php foreach ($jewelryTypes as $type) : ?>
                                <label class="custom-radio">
                                    <input type="radio" id="jewelry_<?php echo $type['id_categorie']; ?>" name="ref_categorie[]" value="<?php echo $type['id_categorie']; ?>">
                                    <span class="radio-mark"></span>
                                    <?php echo $type['nom_categorie']; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>

                    </div>

                    <label for="">Choisir un genre:</label>
                    <select name="genre" id="">
                        <option value="">--Choisir un genre--</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>

                    </select>

                    <br>

                    <button name="update_article" type="submit">Modifier un article</button>
                </form>

            </div>



        </div>
        <div id="delete-form">
            <h2 id="delete_admin">Supprimer un article</h2>
            <div id="filtreArticle">

                <form action="extranet_article.php#delete_admin" method="get">
                    <select name="delete_tri">
                        <option value="">Tous les articles</option>
                        <option value="nom_asc" <?php echo ($deleteTri == 'nom_asc') ? 'selected' : ''; ?>>Nom (A - Z)</option>
                        <option value="nom_desc" <?php echo ($deleteTri == 'nom_desc') ? 'selected' : ''; ?>>Nom (Z - A)</option>
                        <option value="prix_asc" <?php echo ($deleteTri == 'prix_asc') ? 'selected' : ''; ?>>Prix (croissant)</option>
                        <option value="prix_desc" <?php echo ($deleteTri == 'prix_desc') ? 'selected' : ''; ?>>Prix (décroissant)</option>
                    </select>

                    <button type="submit">Trier</button>
                </form>
                <form action="extranet_article.php#delete_admin" method="get">
                    <select name="delete_createur">
                        <option value="">Tous les créateurs</option>
                        <?php foreach ($createurs as $createur) : ?>
                            <option value="<?php echo $createur['id_createur']; ?>" <?php echo ($deleteCreateurId == $createur['id_createur']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($createur['nom_createur']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Filtrer</button>
                </form>

            </div>

            <!-- Liste des articles -->
            <div class="update_list_article">


                <?php foreach ($deleteArticles as $articles) : ?>

                    <div class="article-content">
                        <img src="/Photographie/article/<?php echo $articles['photo_article']; ?>" alt="">
                        <h2><?php echo htmlspecialchars($articles['nom_article']); ?></h2>
                        <h4><?php echo htmlspecialchars($articles['prix_article']); ?> &#8364</h4>
                        <h5>By:<?php echo htmlspecialchars(getCreateurNom($createurs, $articles['ref_createur'])); ?></h5>

                        <p><?php echo htmlspecialchars($articles['description_article']); ?></p>
                        <p>Genre: <?php echo htmlspecialchars($articles['genre']); ?></p>

                        <?php
                        $categories = getCategoriesForArticle($pdo, $articles['id_article']);
                        if (!empty($categories)) {
                            echo "<p>Catégories: " . htmlspecialchars(implode(", ", $categories)) . "</p>";
                        }
                        ?>

                        <button class="admin" onclick='deleteArticle(<?php echo htmlspecialchars(json_encode(array(
                                                                            "id_article" => $articles["id_article"],
                                                                            "nom_article" => $articles["nom_article"],
                                                                            "prix_article" => $articles["prix_article"],
                                                                            "description_article" => $articles["description_article"],
                                                                            "ref_createur" => $articles["ref_createur"],
                                                                            "genre" => $articles["genre"],
                                                                            "categories" => getIdcategoriesforarticle($pdo, $articles["id_article"])
                                                                        )), ENT_QUOTES, 'UTF-8'); ?>, this)'><i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer</button>





                    </div>

                <?php endforeach; ?>


            </div>


            <div id="deleteForm">
                <i id="croix-delete-admin" class="fa-regular fa-circle-xmark"></i>
                <h2>Suppression Article</h2>
                <form action="extranet_article.php" method="post">

                    <input type="hidden" id="deleteId" name="id_article">

                    <p> Êtes-vous sûr de vouloir supprimer l'article :
                        <br>
                        <span id="articleInfo"></span>
                    </p>

                    <button class="admin" name="delete_article" type="submit">Suppression</button>
                </form>

            </div>


            <?php include('extranet_layout/footer-extranet.php') ?>