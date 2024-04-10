<?php
// Vérifier si le cookie de consentement existe
if(isset($_COOKIE['userConsent'])) {
    $userConsent = $_COOKIE['userConsent'];
} else {
    $userConsent = 'unknown';
}

// Enregistrer le consentement de l'utilisateur
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['consent'])) {
    setcookie('userConsent', $_POST['consent'], time() + (86400 * 7), "/"); // 86400 = 1 jour
    // Rediriger l'utilisateur pour éviter la soumission du formulaire à chaque actualisation
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

$message = "";
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	// récupérez user et pass
	$user = isset($_POST['username']) == true ? $_POST['username'] : '';
	$pass = isset($_POST['password']) == true ? $_POST['password'] : '';

    
    //Connexion BD
    include('functions/connexion_db.php') ;       


    $sql = "SELECT *
            FROM administrateur_website
            WHERE username = :username";

    // On execute la requête
    $stmt= $pdo->prepare($sql);
    $stmt->execute(['username' => $user]);

    $userDb = $stmt->fetch();

	// testez user et pass
	if (!empty($userDb) && password_verify($pass, $userDb['password'])) {

		// démarrer la session
		session_start();

		// initialiser une variable de session user
		$_SESSION['username'] = $user;

		// redirection sur extranet.php
		header('Location:extranet/extranet.php');

		// bye
		exit();
	}
	else {

		// sinon : message = pas ok
		$message = 'Vos données de connexion sont incorrect.';
	}
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--LIEN CSS BOOSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!--LIEN VERS LES CSS-->
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/csspages.css">


    <!--LIEN VERS LA FONT FAMILY-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@200&family=Tangerine&display=swap"
        rel="stylesheet">

    <title>La Perle Du Lac</title>
</head>

<body>

    <!--HEADER-->

    <header class="header-content">

        <!--BARRE DU HAUT-->

        <div id="barreduhaut">

            <div id="gauche">
                <div id="telephone">
                    <a href="tel:+4100000000000"><i class="fa-solid fa-phone" style="color: #ffffff;"></i></a>
                </div>

                <div id="mail">
                    <a href="mailto:contact@laperdulac.ch"><i class="fa-regular fa-envelope"
                            style="color: #ffffff;"></i> </a>
                </div>


                <div id="localisation">
                    <a href="/Pages/contact.html#carte"><i class="fa-solid fa-location-dot"></i> Nous trouver</a>
                </div>

            </div>


            <div id="droite">
                <div id="loupe">
                    <a href=""><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></a>
                    <input placeholder="Rechercher" type="text" class="inputrecherche">
                </div>

                    <?php
                    // Déterminer si la page actuelle est back-admin.php
                    $isBackAdminPage = basename($_SERVER['REQUEST_URI']) == 'back-admin.php';
                    ?>

                    <div id="moncompte" style="<?php echo $isBackAdminPage ? 'display: none;' : ''; ?>">
                        <button class="button-account" href=""><i class="fa-solid fa-user" style="color: #ffffff;"></i> Mon compte</button>
                    </div>

                    <div id="administrateur" style="<?php echo $isBackAdminPage ? '' : 'display: none;'; ?>">
                        <button class="button-admin" href=""><i class="fa-solid fa-user" style="color: #ffffff;"></i> Administrateur</button>
                    </div>

                <div id="panier">
                    <a href=""><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i> (0)</a>
                </div></a>
            </div>

        </div>

        <!--FIN BARRE DU HAUT-->
        <hr id="hr1">

        <!--NAVIGATION-->

        <a href="../index.php">
            <div class="logo">
                <img src="../logo/logo.png" alt="Logo">
                <h1>La Perle Du Lac</h1>
            </div>
        </a>
        <nav class="website">
            <hr>

            <ul>
                <li class="sousmenuN underline"><a href="/Pages/nouveaute.php">NOUVEAUTÉES</a></li>

                <li class="sousmenuJ underline"><a href="#">JOAILLERIE</a></li>

                <li class="sousmenuP underline"><a href="#">PIERRE PRÉCIEUSE</a></li>

                <li class="sousmenuH underline"><a href="#">HORLOGERIE</a></li>

                <li class="underline"><a href="/Pages/lamaison.php">LA MAISON</a></li>

                <li class="underline"><a href="/Pages/contact.php">CONTACT</a></li>

            </ul>


            <div id="joaillerie">
                <div class="texte">
                    <ul>
                        <li class="underline"><a href="#">BAGUE</a></li>
                        <li class="underline"><a href="#">BOUCLES D'OREILLES</a></li>
                        <li class="underline"><a href="#">BRACELETS</a></li>
                        <li class="underline"><a href="#">COLLIERS</a></li>
                    </ul>
                </div>
                <div class="img">
                    <img src="/Photographie/sousmenu/joailleriesousmenu.png" alt="">
                </div>

                <hr>

            </div>


            <div id="horlogerie">
                <div class="texte">
                    <ul>
                        <li class="underline"><a href="#">MONTRES HOMME</a></li>
                        <li class="underline"><a href="#">MONTRES FEMME</a></li>
                    </ul>
                </div>
                <div class="img">
                    <img src="/Photographie/sousmenu/photosousmenumontre.png" alt="">
                </div>
            </div>

            <div id="pierreprecieuse">
                <div class="texte">
                    <ul>
                        <li class="underline"><a href="#">DIAMANT</a></li>
                        <li class="underline"><a href="#">EMERAUDE</a></li>
                        <li class="underline"><a href="#">RUBIS</a></li>
                        <li class="underline"><a href="#">SAPHIR</a></li>
                    </ul>
                </div>
                <div class="img">
                    <img src="/Photographie/sousmenu/sousmenupierreprecieuse.png" alt="">
                </div>
            </div>
          
            <div id="nouveaute">
                <a href="/Pages/nouveaute.html#lunar"><div id="n1">
                    <p class="hoverp">LUNAR</p>
                    <img src="/Photographie/lune/c1.png" alt="" class="hover">
                </div></a>
                <a href="/Pages/nouveaute.html#venusax"><div id="n2">
                    <p class="hoverp">VENUSAX</p>
                    <img src="/Photographie/venus/c1.png" alt="" class="hover">
                </div></a>
                <a href="/Pages/nouveaute.html#marsov"><div id="n3">
                    <p class="hoverp">MARSOV</p>
                    <img src="/Photographie/mars/c1.png" alt="" class="hover">
                 </div></a>
              
            </div>
           
            </div>
            <hr id="hr2">
        </nav>







        <!--MENU HAMBURGER**************************-->
        <div class="navbar1">
            <div class="container1 nav-container1">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div id="hamburgerlogo" class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
                <div class="logo">

                </div>


                <div class="menu-items1">
                    <li><a href="/Pages/nouveaute.php">NOUVEAUTÉES</a></li>
                    <li><a class="sm1" href="#">JOAILLERIE <i class="fa-solid fa-circle-chevron-down"
                                style="color: #ffffff;"></i> </a></li>
                    <ul class="sousmenu1">
                        <li><a href="#">&#8718; BAGUE</a></li>
                        <li><a href="#">&#8718; BOUCLES D'OREILLES</a></li>
                        <li><a href="#">&#8718; BRACELETS</a></li>
                        <li><a href="#">&#8718; COLLIERS</a></li>
                    </ul>

                    <li><a class="sm2" href="#">PIERRE PRÉCIEUSE <i class="fa-solid fa-circle-chevron-down"
                                style="color: #ffffff;"></i></a></li>
                    <ul class="sousmenu2">
                        <li><a href="#">&#8718; DIAMANT</a></li>
                        <li><a href="#">&#8718; EMERAUDE</a></li>
                        <li><a href="#">&#8718; RUBIS</a></li>
                        <li><a href="#">&#8718; SAPHIR</a></li>
                    </ul>

                    <li><a class="sm3" href="#">HORLOGERIE <i class="fa-solid fa-circle-chevron-down"
                                style="color: #ffffff;"></i></a></li>
                    <ul class="sousmenu3">
                        <li><a href="#">&#8718; MONTRES HOMME</a></li>
                        <li><a href="#">&#8718; MONTRES FEMME</a></li>
                    </ul>

                    <li><a href="/Pages/lamaison.php">LA MAISON</a></li>
                    <li><a href="/Pages/contact.php">CONTACT</a></li>
                    <li><a href="tel:+4100000000000"><i class="fa-solid fa-phone" style="color: #ffffff;"></i></a><a
                            href="mailto:contact@laperdulac.ch"><i class="fa-regular fa-envelope"
                                style="color: #ffffff;"></i> </a></li>
                    <li>
                        <div id="loupe">
                            <a href=""><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></a>
                            <input placeholder="Rechercher" type="text" class="inputrechercheh">
                        </div>
                    </li>
                    <li>  <div id="moncompte" style="<?php echo $isBackAdminPage ? 'display: none;' : ''; ?>">
                        <button class="button-account" href=""><i class="fa-solid fa-user" style="color: #ffffff;"></i> Mon compte</button>
                    </div>

                    <div id="administrateur" style="<?php echo $isBackAdminPage ? '' : 'display: none;'; ?>">
                        <button class="button-admin" href=""><i class="fa-solid fa-user" style="color: #ffffff;"></i> Administrateur</button>
                    </div></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i> (0)</a></li>

                </div>
            </div>
        </div>
        </div>

        <!--FIN NAVIGATION-->
    </header>



    <!--FIN HEADER-->