<?php include('layout/header.php');

?>





 <!--DIV POUR LOGIN ADMIN-->

 

 <div class="admin-login-form" style="<?php echo empty($message) ? :'left: 0px;'; ?>">
    <div class="logo-croix">
    <img class="logo-admin" src="../logo/logo.png" alt="Logo">
    <i id="croix-admin" class="fa-regular fa-circle-xmark"></i>

    </div>
 <hr class="hr-admin-1">
 <h4>Portail administrateur</h4>
 <hr class="hr-admin-2">
    <form action="" method="post" id="login-admin">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <button type="submit">Connexion</button>
        </div>
    </form>

    <?php 
        if (!empty($message)) {
            echo "<p>$message</p>";
        }
    ?>
    <a href="">Vous avez oublié votre mot de passe ?</a>

</div>

    <!--CAROUSEL BOOSTRAP-->
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel3.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel4.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel5.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel6.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="4000">
                <img src="/Photographie/carousel/carousel7.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="boutoncarousel"><a href="/Pages/nouveaute.html"> Découvrez nos dernières création </a></div>
                    </div>
                </div>
            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--FIN CAROUSEL BOOSTRAP-->
    <div id="laperle">
        <h1 class="tangerine">
            La Perle Du Lac
        </h1>
        <hr id="hr4">
     
            <p class="jet" id="textlaperle">
                Située au cœur de Genève, "La Perle Du Lac" est la destination de choix pour les amateurs de bijoux raffinés. Depuis sa création en 1985, notre bijouterie propose des pièces uniques inspirées de la beauté du Lac Léman et de son environnement majestueux.
            </p>
            
      
    </div>

    <!--DEBUT DIV PHOTO ET TEXTE A DROITE-->
    <div id="phototext">

        <div id="phototextphoto">
            <img src="/Photographie/sousmenu/nouveaute1.png" alt="">
        </div>
        <div id="phototexttext">
            <h2>Éclat Saphir</h2>
            <h3>La nouvelle collection de bagues</h3>
            <div id="quote">
                <p>Découvrez notre nouvelle collection de bagues ornées de saphirs scintillants, chaque pièce capturant l'essence même de la beauté et de la majesté de cette pierre précieuse. Chaque bague est soigneusement conçue pour refléter la pureté et la profondeur du saphir, offrant une élégance intemporelle à ceux qui la portent.</p>
            </div>
            
            <a href="">Découvrir</a>
        </div>

    </div>
    <!--FIN DIV PHOTO ET TEXTE A DROITE-->

    <!--DEBUT DIV PHOTO PUB-->
    <div id="photopub">
        <a href="">Découvrez nos dernières création de collier</a>
    </div>
    <!--FIN DIV PHOTO PUB-->

    <h1 id="h1dark">Montres de notre créateur, inpiration obscure.</h1>

<hr>

    <!--DEBUT DIV PHOTO 9Photo-->
    <div id="nine">
        <div id="ninephotoparent">
            <div id="ninegauche">
                <img src="/Photographie/montre/1.png" alt="">
            </div>
            <div id="ninedroite">
                <img src="/Photographie/montre/0.png" alt="">
                <img src="/Photographie/montre/2.png" alt="">
                <img src="/Photographie/montre/3.png" alt="">
                <img src="/Photographie/montre/4.png" alt="">
                <img src="/Photographie/montre/5.png" alt="">
                <img src="/Photographie/montre/6.png" alt="">
                <img src="/Photographie/montre/7.png" alt="">
                <img src="/Photographie/montre/8.png" alt="">
                <img src="/Photographie/montre/9.png" alt="">
                
               

            </div>
        </div>
    </div>

    <!--FIN DIV PHOTO 9Photo-->


    <!--DEBUT DIV NEWSLETTER-->

    <div id="formnews">
        <hr id="hr5">
        <h3>Abonnez-vous à notre newsletter</h3>
        <form id="newsletter" onsubmit="return false;">
            <div>

                <input type="mail" id="emailInput" placeholder="Email (champ obligatoire)">

            </div>
            <div>
                <button type="submit" id="buttonnewsletter">Envoyer</button>
            </div>
        </form>
        <div id="emailError"></div>
        <div id="thankYouMessage"></div>
        <hr id="hr6">
    </div>


    <!--FIN DIV NEWSLETTER-->



<?php include('layout/footer.php')?>