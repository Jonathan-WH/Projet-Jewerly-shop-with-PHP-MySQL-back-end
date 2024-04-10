</head>

<body>

    <header class="header-extra">

        <div class="logo_extranet"><a href="/extranet/extranet.php"><img src="/logo/logo.png" alt=""></a></div>
        <div class="h1_extranet">
            <h1><a class="extranet-h1" href="/extranet/extranet.php">La perle du lac</a></h1>
        </div>

    </header>

    <div class="administrateur-page">
        <div class="navigation-extra">

            <div>
                <p>Salut <span class="user-extra"><?php echo $user; ?></span>, ravi de te revoir !</p>
            </div>

            <form class="logout" action="/functions/logout.php" method="post">
                <button class="deconnexion-extra " type="submit" name="logout">Déconnexion</button>
            </form>

            <nav>
                <ul class="administrateur-extra">
                    <h4><a href="/extranet/extranet_administrateur.php">Administrateur</a></h4>
                    <li>
                        <a href="/extranet/extranet_administrateur.php/#add_admin"><i class="fa-solid fa-plus"></i> Ajouter un administrateur</a>
                    </li>

                    <li>
                        <a href="extranet_administrateur.php/#update_admin"><i class="fa-solid fa-pen"></i> Modifier un administrateur </a>
                    </li>

                    <li>
                        <a href="extranet_administrateur.php/#delete_admin"><i class="fa-solid fa-trash"></i> Supprimer un administrateur </a>
                    </li>
                </ul>

                <ul class="createur-extra">
                    <h4><a href="/extranet/extranet_createur.php">Créateur</a></h4>
                    <li>
                        <a href="/extranet/extranet_createur.php#add_createur"><i class="fa-solid fa-plus"></i> Ajouter un créateur</a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_createur.php#update_createur"><i class="fa-solid fa-pen"></i> Modifier un créateur </a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_createur.php#delete_createur"><i class="fa-solid fa-trash"></i> Supprimer un créateur </a>
                    </li>
                </ul>

                <ul class="article-extra">
                    <h4><a href="/extranet/extranet_article.php">Article</a></h4>
                    <li>
                        <a href="/extranet/extranet_article.php#add_admin"><i class="fa-solid fa-plus"></i> Ajouter un article</a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_article.php#update_admin"><i class="fa-solid fa-pen"></i> Modifier un article </a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_article.php#delete_admin"><i class="fa-solid fa-trash"></i> Supprimer un article </a>
                    </li>
                </ul>

                <ul class="categorie-extra">
                    <h4><a href="/extranet/extranet_categorie.php">Catégorie</a></h4>
                    <li>
                        <a href="/extranet/extranet_categorie.php#add_categorie"><i class="fa-solid fa-plus"></i> Ajouter une catégorie</a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_categorie.php#update_categorie"><i class="fa-solid fa-pen"></i> Modifier une catégorie </a>
                    </li>

                    <li>
                        <a href="/extranet/extranet_categorie.php#delete_categorie"><i class="fa-solid fa-trash"></i> Supprimer une catégorie </a>
                    </li>
                </ul>
            </nav>
        </div>