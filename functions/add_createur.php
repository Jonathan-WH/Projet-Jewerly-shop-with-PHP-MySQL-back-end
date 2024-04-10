<?php // Traiter le premier formulaire AJOUTER un createur
        $createur = isset($_POST['createur']) ? trim($_POST['createur']) : '';
        $website = isset($_POST['website']) ? trim($_POST['website']) : '';
        $error = '';
    
        // Validation des données
        if (empty($createur) || empty($website)) {
            $error = 'Tous les champs doivent être remplis.';
        } else {
            
            // Autres validation
    
            if (strlen($createur) < 3 || strlen($createur) > 25) {
                // Validation : Longueur du nom d'utilisateur
                $error = "Le nom du créateur doit contenir entre 3 et 25 caractères.";
            }
    
            if (strlen($website) < 10 || strlen($website) > 30) {
                // Validation : Longueur du nom d'utilisateur
                $error = "Le website du créateur doit contenir entre 10 et 30 caractères.";
            }
            
        }
    
        if (empty($error)) {
                $sql = "INSERT INTO createur (nom_createur, website) VALUES (:nom_createur, :website)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['nom_createur' => $createur, 'website' => $website]);
                $message_new_add = "Le créateur $createur à été créer avec succès";
                
                
            }

            ?>