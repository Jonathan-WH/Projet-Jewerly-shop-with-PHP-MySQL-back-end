<?php
//*************************************SESSION
include('../functions/session.php');

// ************************************************CONNEXION BASEDEDONNEE
include('../functions/connexion_db.php');

$message_new_add = '';
$message_update = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_createur'])) {
        include('../functions/add_createur.php');

    } elseif (isset($_POST['update_createur'])) {
        include('../functions/update_createur.php');
        
    } elseif (isset($_POST['delete_createur'])) {
        include('../functions/delete_createur.php');
    }
}


// Requête pour sélectionner tous les administrateurs, triés par nom de famille pour affichier les donnée pour les modifications
$sql_update = "SELECT * FROM createur ORDER BY nom_createur ASC";
$stmt1 = $pdo->prepare($sql_update);
$stmt1->execute();

// Récupérer tous les résultats
$createur = $stmt1->fetchAll(PDO::FETCH_ASSOC);

include('extranet_layout/header_extranet.php')
?>



<title>Créateur</title>


<?php include('extranet_layout/nav-extranet.php') ?>


<div class="content-admin">

    <h1 class="top-title">Créateur</h1>
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
        <h2 id="add_createur">Ajouter un créateur:</h2>

        <form id="form_add_admin" action="extranet_createur.php" method="post">

            <label for="">Créateur :</label>
            <input name="createur" type="text">

            <label for="">Website :</label>
            <input name="website" type="text">

            <br>

            <button name="add_createur" type="submit">Ajouter un créateur</button>
        </form>

    </div>

    <div class="admin_add_content">
        <h2 id="update_createur">Modifier un créateur</h2>

        <!-- Liste des administrateurs -->
        <div class="update_list_admin">

            <table>
                <thead>
                    <tr>
                        <th>Créateur</th>
                        <th>Website</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($createur as $creat) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($creat['nom_createur']); ?></td>
                            <td><?php echo htmlspecialchars($creat['website']); ?></td>
                            <td>
                                <button class="creat" onclick="editCreat(<?php echo htmlspecialchars(json_encode($creat)); ?>)">
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
            <h2>Modifier Créateur</h2>
            <form action="extranet_createur.php" method="post">

                <input type="hidden" id="editId" name="id_createur">

                <label for="">Créateur:</label>
                <input type="text" id="editCreateur" name="nom_createur">
                <label for="">Website :</label>
                <input type="text" id="editWebsite" name="website">
                <button class="admin" name="update_createur" type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <div id="delete-form">
        <h2 id="delete_createur">Supprimer un créateur</h2>

        <!-- Liste des administrateurs -->
        <div class="delete_form">

            <table>
                <thead>
                    <tr>
                        <th>Créateur</th>
                        <th>Website</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($createur as $creat) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($creat['nom_createur']); ?></td>
                            <td><?php echo htmlspecialchars($creat['website']); ?></td>
                            <td>
                                <button class="creat" onclick="deleteCreat(<?php echo htmlspecialchars(json_encode($creat)); ?>)">
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
            <h2>Suppression Créateur</h2>
            <form action="extranet_createur.php" method="post">

                <input type="hidden" id="deleteId" name="id_createur">

                <p> Êtes-vous sûr de vouloir supprimer le créateur :
                    <br>
                    <span id="creatInfo"></span>
                </p>

                <button class="admin" name="delete_createur" type="submit">Suppression</button>
            </form>

        </div>
    </div>
</div>




<?php include('extranet_layout/footer-extranet.php') ?>