<?php
//*************************************SESSION
include('../functions/session.php');

// ************************************************CONNEXION BASEDEDONNEE
include('../functions/connexion_db.php');


/***************************/
$message_new_add = '';
$message_update = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_admin'])) {

        include('../functions/add_admin.php');

    } elseif (isset($_POST['update_admin'])) {

        include('../fonctions/update_admin.php');

    } elseif (isset($_POST['delete_admin'])) {
        
        include('../functions/delete_admin.php');
    }
}

// Requête pour sélectionner tous les administrateurs, triés par nom de famille pour affichier les donnée pour les modifications
$sql_update = "SELECT * FROM administrateur_website ORDER BY nom ASC";
$stmt1 = $pdo->prepare($sql_update);
$stmt1->execute();

// Récupérer tous les résultats
$administrateurs = $stmt1->fetchAll(PDO::FETCH_ASSOC);

//requete pour selectionner l'id pour la modification avec le formulaire
$id = isset($_GET['id_user']) ? intval($_GET['id_user']) : 0;
$sql_update_form = "SELECT * FROM administrateur_website WHERE id_user = :id";
$stmt2 = $pdo->prepare($sql_update_form);
$stmt2->execute(['id' => $id]);

// Récupérer tous les résultats
$admin = $stmt2->fetch(PDO::FETCH_ASSOC);


include('extranet_layout/header_extranet.php')


?>



<title>Administreur</title>

<?php include('extranet_layout/nav-extranet.php') ?>


<div class="content-admin">

    <h1 class="top-title">Administrateur</h1>

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
        <h2 id="add_admin">Ajouter un administrateur:</h2>

        <form id="form_add_admin" action="extranet_administrateur.php" method="post">

            <label for="">Pseudo :</label>
            <input name="username" type="text">

            <label for="password">Password :<button type="button" id="togglePassword">👁</button></label>
            <input name="password" type="password" id="password">

            <label for="">Nom :</label>
            <input name="nom" type="text">

            <label for="">Prénom :</label>
            <input name="prenom" type="text">

            <label for="">Email :</label>
            <input name="email" type="mail">

            <br>

            <button name="add_admin" type="submit">Ajouter un administrateur</button>
        </form>

    </div>

    <div class="admin_add_content">
        <h2 id="update_admin">Modifier un administrateur</h2>

        <!-- Liste des administrateurs -->
        <div class="update_list_admin">

            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($administrateurs as $admin) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($admin['nom']); ?></td>
                            <td><?php echo htmlspecialchars($admin['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                            <td>
                                <button class="admin" onclick="editAdmin(<?php echo htmlspecialchars(json_encode($admin)); ?>)">
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
            <h2>Modifier Administrateur</h2>
            <form action="extranet_administrateur.php" method="post">

                <input type="hidden" id="editId" name="id_user">

                <label for="">Pseudo:</label>
                <input type="text" id="editUsername" name="username">
                <label for="">Nom :</label>
                <input type="text" id="editNom" name="nom">
                <label for="">Prénnom :</label>
                <input type="text" id="editPrenom" name="prenom">
                <label for="">Email</label>
                <input type="email" id="editEmail" name="email">
                <label for=""></label>
                <button class="admin" name="update_admin" type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <div id="delete-form">
        <h2 id="delete_admin">Supprimer un administrateur</h2>

        <!-- Liste des administrateurs -->
        <div class="delete_form">

            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($administrateurs as $admin) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($admin['nom']); ?></td>
                            <td><?php echo htmlspecialchars($admin['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td><?php echo htmlspecialchars($admin['email']); ?></td>
                            <td>
                                <button class="admin" onclick="deleteAdmin(<?php echo htmlspecialchars(json_encode($admin)); ?>)">
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
            <h2>Suppression Administrateur</h2>
            <form action="extranet_administrateur.php" method="post">

                <input type="hidden" id="deleteId" name="id_user">

                <p> Êtes-vous sûr de vouloir supprimer l'administrateur :
                    <br>
                    <span id="adminInfo"></span>
                </p>

                <button class="admin" name="delete_admin" type="submit">Suppression</button>
            </form>

        </div>
    </div>
</div>




<?php include('extranet_layout/footer-extranet.php') ?>