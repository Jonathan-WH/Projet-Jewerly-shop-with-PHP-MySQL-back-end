<?php
//*************************************SESSION
include('../functions/session.php');

// ************************************************CONNEXION BASEDEDONNEE
include('../functions/connexion_db.php');

$message_new_add = '';
$message_update = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_categorie'])) {
        include('../functions/add_categorie.php');

    } elseif (isset($_POST['update_categorie'])) {
        include('../functions/update_categorie.php');
        
    } elseif (isset($_POST['delete_categorie'])) {
        include('../functions/delete_categorie.php');
    }
}

// Requête pour sélectionner tous les catégorie, triés par nom 
$sql_update = "SELECT * FROM categorie ORDER BY nom_categorie ASC";
$stmt1 = $pdo->prepare($sql_update);
$stmt1->execute();

// Récupérer tous les résultats
$categorie = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Pour afficher les type catégorie dans le champs catégorie
$categories = $pdo->query("SELECT DISTINCT type_categorie FROM categorie")->fetchAll(PDO::FETCH_ASSOC);



include('extranet_layout/header_extranet.php')

?>



<title>Catégorie</title>


<?php include('extranet_layout/nav-extranet.php') ?>


<div class="content-admin">

    <h1 class="top-title">Catégorie</h1>
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
        <h2 id="add_categorie">Ajouter une catégorie:</h2>

        <form id="form_add_admin" action="extranet_categorie.php" method="post">

            <label for="">Catégorie :</label>
            <input name="nom_categorie" type="text">


            <label for="">Choisir un type de catégorie :</label>
            <select name="type_categorie" id="">
                <option value="">--Choisir un type de catégorie--</option>
                <?php foreach ($categories as $categorievalue) : ?>
                    <option value="<?php echo htmlspecialchars($categorievalue['type_categorie']); ?>">
                        <?php echo htmlspecialchars($categorievalue['type_categorie']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <button name="add_categorie" type="submit">Ajouter une catégorie</button>
        </form>

    </div>

    <div class="admin_add_content">
        <h2 id="update_categorie">Modifier une catégorie</h2>

        <!-- Liste des administrateurs -->
        <div class="update_list_admin">

            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Type de Catégorie</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorie as $cat) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['nom_categorie']); ?></td>
                            <td><?php echo htmlspecialchars($cat['type_categorie']); ?></td>
                            <td>
                                <button class="cat" onclick="editCat(<?php echo htmlspecialchars(json_encode($cat)); ?>)">
                                    <i class="fa-solid fa-pen"></i> Éditer
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Formulaire de modification (caché initialement) -->
        <div id="editForm">
            <i id="croix-update-admin" class="fa-regular fa-circle-xmark"></i>
            <h2>Modifier Catégorie</h2>
            <form action="extranet_categorie.php" method="post">

                <input type="hidden" id="editId" name="id_categorie">

                <label for="">Catégorie:</label>
                <input type="text" id="editCategorie" name="nom_categorie">

                <select name="type_categorie" id="">
                    <option value="">--Choisir un type de catégorie--</option>
                    <?php foreach ($categories as $categorievalue) : ?>
                        <option value="<?php echo htmlspecialchars($categorievalue['type_categorie']); ?>">
                            <?php echo htmlspecialchars($categorievalue['type_categorie']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="admin" name="update_categorie" type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <div id="delete-form">
        <h2 id="delete_categorie">Supprimer une catégorie</h2>

        <!-- Liste des administrateurs -->
        <div class="delete_form">

            <table>
                <thead>
                    <tr>
                        <th>Catégorie</th>
                        <th>Type de Catégorie</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorie as $cat) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['nom_categorie']); ?></td>
                            <td><?php echo htmlspecialchars($cat['type_categorie']); ?></td>
                            <td>
                                <button class="cat" onclick="deleteCat(<?php echo htmlspecialchars(json_encode($cat)); ?>)">
                                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Supprimer
                                </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="deleteForm">
            <i id="croix-delete-admin" class="fa-regular fa-circle-xmark"></i>
            <h2>Suppression Catégorie</h2>
            <form action="extranet_categorie.php" method="post">

                <input type="hidden" id="deleteId" name="id_categorie">

                <p> Êtes-vous sûr de vouloir supprimer la catégorie :
                    <br>
                    <span id="catInfo"></span>
                </p>

                <button class="admin" name="delete_categorie" type="submit">Suppression</button>
            </form>

        </div>
    </div>
</div>

<?php include('extranet_layout/footer-extranet.php') ?>