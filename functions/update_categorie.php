<?php
 // Traiter le second formulaire MODIFICATION ADMINISTRATEUR
 $id_categorie = isset($_POST['id_categorie']) ? intval($_POST['id_categorie']) : 0;
 $nom_categorie = isset($_POST['nom_categorie']) ? trim($_POST['nom_categorie']) : '';
 $type_categorie = isset($_POST['type_categorie']) ? trim($_POST['type_categorie']) : '';

 $error2 = '';

 //MODIFIER UNE CATEGORIE
 // Validation des données
 if (empty($nom_categorie || $type_cagtegorie)) {
     $error2 = 'Tous les champs doivent être remplis';
 } else {

     // Autres validation


     if (strlen($nom_categorie) < 3 || strlen($nom_categorie) > 30) {
         // Validation : Longueur du nom d'utilisateur
         $error = "La catégorie doit contenir entre 3 et 30 caractères.";
     }
 }

 if (empty($error2)) {
     // Mise à jour dans la base de données
     $sql = "UPDATE categorie SET nom_categorie = :nom_categorie, type_categorie = :type_categorie WHERE id_categorie = :id_categorie";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([
         'id_categorie' => $id_categorie,
         'nom_categorie' => $nom_categorie,
         'type_categorie' => $type_categorie

     ]);

     if (!$stmt->execute([
         'id_categorie' => $id_categorie,
         'nom_categorie' => $nom_categorie,
         'type_categorie' => $type_categorie

     ])) {
         // La requête a échoué
         $errorInfo = $stmt->errorInfo();
         echo "Erreur SQL: " . $errorInfo[2];
     }


     $message_update = "La catégorie $nom_categorie à été mise à jour avec succès.";
 };

 ?>