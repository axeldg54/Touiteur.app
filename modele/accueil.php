<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Touiteur</title>
    <link rel="stylesheet" href="styles.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
</head>
<body>
<div class="sidebar">

    <h1>
        <center>Touite</center>
    </h1>

    <i class="fab fa-touiteur"></i>

    <!-- Déroulement de la liste des touites -->
    <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown">
            <option value="">Selectionner touite</option>
            <option value="tweet1">touite 1</option>
            <option value="tweet2">touite 2</option>
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
        </select>
    </div>

    <!-- Déroulement de la liste des auteurs -->
    <div class="sidebarOption">
        <select id="authors-dropdown" class="sidebar__dropdown">
            <option value="">Selectionner auteur</option>
            <option value="author1">auteur 1</option>
            <option value="author2">auteur 2</option>
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
        </select>
    </div>

    <!-- Déroulement de la liste des auteurs -->
    <div class="sidebarOption">
        <select id="tags-dropdown" class="sidebar__dropdown">
            <option value="">Select Tag</option>
            <option value="tag1">#tag1</option>
            <option value="tag2">#tag2</option>
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
        </select>
    </div>
</div>
<!-- sidebar fin -->


<!-- feed debut -->
<div class="feed">

    <div class="feed__static">

        <div class="feed__header">
            <h2>Accueil</h2>
        </div>

        <!-- touitebox debut -->
        <div class="tweetBox">
            <button class="btn-touiter">Touiter</button>

            <!--         ANCIENNE FORME | ZONE TEXTUELLE
            <form>
              <div class="tweetbox__input">
                <img
                  src ="images/user.png"
                  alt=""
                />
                <input type="text" placeholder="Quoi de neuf ?" />
              </div>
              <button class="tweetBox__tweetButton">Touite</button>
            </form>
            -->

        </div>
    </div>
    <!-- feed__static fin -->

    <!-- touite box fin -->

    <div class="posts__container">

        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->

        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->

        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->

        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->

        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->
        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->
        <!-- post debut -->
        <div class="post">
            <div class="post__avatar">
                <img
                        src="images/user.png"
                        alt=""
                />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            User
                            <span class="post__headerSpecial"
                            ><span class="material-icons post__badge"> verified </span>@user</span
                            >
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <img
                        src="images/what.avif"
                        alt=""
                />
            </div>
        </div>
        <!-- post fin -->

    </div>
    <!-- posts__container fin -->


</div>
<!-- feed fin -->

    <!-- widgets debut -->
    <div class="widgets">
        <div class="widgets__loginButtons">
            <a href="?action=sign-in" class="loginButton">Connexion</a>
            <a href="?action=register" class="loginButton">Inscription</a>
        </div>

        <div class="widgets__input">
            <span class="material-icons widgets__searchIcon">search</span>
            <input type="text" placeholder="Rechercher Touite" />
        </div>

        <div class="widgets__widgetContainer">
            <h2>Que se passe-t-il ?</h2>
        </div>
    </div>
    <!-- widgets fin -->



  </body>
</html>

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        --twitter-color: #3f4e4e;
        --twitter-background: #e6ecf0;

    }

    .sidebarOption {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .sidebarOption .material-icons,
    .fa-twitter {
        padding: 20px;
    }

    .sidebarOption h2 {
        font-weight: 800;
        font-size: 20px;
        margin-right: 20px;
    }

    .sidebarOption:hover {
        background-color: var(--twitter-background);
        border-radius: 30px;
        color: var(--twitter-color);
        transition: color 100ms ease-out;
    }

    .sidebarOption.active {
        color: var(--twitter-color);
    }

    .sidebar__tweet {
        width: 100%;
        background-color: var(--twitter-color);
        border: none;
        color: white;
        font-weight: 900;
        border-radius: 30px;
        height: 50px;
        margin-top: 20px;
    }

    body {
        display: flex;
        height: 100vh;
        max-width: 1300px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 10px;
    }

    .sidebar {
        border-right: 1px solid var(--twitter-background);
        flex: 0.2;

        min-width: 250px;
        margin-top: 20px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .fa-twitter {
        color: var(--twitter-color);
        font-size: 30px;
    }

    .feed {
        flex: 0.5;
        border-right: 1px solid var(--twitter-background);
        min-width: fit-content;
        overflow-y: scroll;
    }

    .feed__header {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 100;
        border: 1px solid var(--twitter-background);
        padding: 15px 20px;
    }

    .feed__header h2 {
        font-size: 20px;
        font-weight: 800;
    }

    .feed::-webkit-scrollbar {
        display: none;
    }

    .feed {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* TOUTIE BOX */
    .tweetbox__input img {
        border-radius: 50%;
        height: 40px;
    }

    .tweetBox {
        padding-bottom: 10px;
        border-bottom: 8px solid var(--twitter-background);
        padding-right: 10px;
    }

    .tweetBox form {
        display: flex;
        flex-direction: column;
    }

    .tweetbox__input {
        display: flex;
        padding: 20px;
    }

    .tweetbox__input input {
        flex: 1;
        margin-left: 20px;
        font-size: 20px;
        border: none;
        outline: none;
    }

    .tweetBox__tweetButton {
        background-color: var(--twitter-color);
        border: none;
        color: white;
        font-weight: 900;

        border-radius: 30px;
        width: 80px;
        height: 40px;
        margin-top: 20px;
        margin-left: auto;
    }

    .post__avatar img {
        border-radius: 50%;
        height: 40px;
    }

    .post {
        display: flex;
        align-items: flex-start;
        border-bottom: 1px solid var(--twitter-background);
        padding-bottom: 10px;
    }

    .post__body img {
        width: 450px;
        object-fit: contain;
        border-radius: 20px;
    }

    .post__footer {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .post__badge {
        font-size: 14px !important;
        color: var(--twitter-color);
        margin-right: 5px;
    }

    .post__headerSpecial {
        font-weight: 600;
        font-size: 12px;
        color: gray;
    }

    .post__headerText h3 {
        font-size: 15px;
        margin-bottom: 5px;
    }

    .post__headerDescription {
        margin-bottom: 10px;
        font-size: 15px;
    }

    .post__body {
        flex: 1;
        padding: 10px;
    }

    .post__avatar {
        padding: 20px;
    }

    /* widgets */
    .widgets {
        flex: 0.3;
    }

    .widgets__input {
        display: flex;
        align-items: center;
        background-color: var(--twitter-background);
        padding: 10px;
        border-radius: 20px;
        margin-top: 10px;
        margin-left: 0; /* Ajusté pour être collé à gauche */
        align-self: flex-start; /* Ajustement pour l'alignement à gauche */
    }

    .widgets__input input {
        border: none;
        background-color: var(--twitter-background);
        flex: 1; /* Permet à l'input de prendre l'espace disponible */
    }

    .widgets__searchIcon {
        color: gray;
    }

    .widgets__widgetContainer {
        margin-top: 15px;
        margin-left: 20px;
        padding: 20px;
        background-color: #f5f8fa;
        border-radius: 20px;
    }

    .widgets__widgetContainer h2 {
        font-size: 18px;
        font-weight: 800;
    }

    .sidebar__dropdown {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        border: 1px solid #e6ecf0;
        background-color: white;
        color: gray;
        cursor: pointer;
    }

    .sidebarOption {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
    }

    .sidebarOption:hover {
        background-color: #e8f5fe;
    }
    /* styliser les boutons */
    .loginButton {
        padding: 10px 20px;
        margin-right: 10px; /* Espacement entre les boutons */
        border: none;
        color: white;
        background-color: dimgray;
        border-radius: 20px; /* Boutons arrondis */
        cursor: pointer;
        outline: none;
    }

    .widgets {
        display: flex;
        flex-direction: column;
        margin-left: 15px;
    }

    /* pour ajuster la taille et l'espacement des icônes de recherche si nécessaire */
    .widgets__searchIcon {
        /* nos styles ici si on souhaite ajuster l'icône */
    }

    .widgets__loginButtons {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        margin-top: 10px;
        margin-left: 1px;
    }

    .loginButton {
        /*  CSS pour les boutons */
    }


    .widgets__searchIcon {
        /*  CSS pour l'icône */
    }

    .widgets__widgetContainer {
        margin-top: 15px;
        margin-left: 0; /* Ajusté pour être collé à gauche */
        padding: 20px;
        background-color: #f5f8fa;
        border-radius: 20px;
        align-self: flex-start; /* Ajustement pour l'alignement à gauche */
    }

    .btn-touiter {
        padding: 30px 20px; /* Ajustez la taille selon vos besoins */
        font-size: 1.5em; /* Ajustez la taille de la police comme vous le souhaitez */
        background-color: darkgray; /* Choisissez une couleur de fond */
        color: white; /* Choisissez une couleur de texte */
        border: none;
        border-radius: 20px; /* Ajustez pour l'arrondissement des coins */
        cursor: pointer;
        margin: 20px 0; /* Ajoutez un peu d'espace avant et après le bouton */
        display: block; /* Si vous voulez que le bouton soit centré */
        width: 35%; /* ou une certaine largeur selon votre mise en page */
        margin-left: auto; /* Si 'display: block' est réglé, cela centrera le bouton */
        margin-right: auto; /* Si 'display: block' est réglé, cela centrera le bouton */
    }

    .btn-touiter:hover {
        background-color: midnightblue; /* Couleur lors du survol du bouton */
    }

    .feed__static {
        /* Ajoutez les styles nécessaires pour la mise en page statique */
    }

    .posts__container {
        max-height: calc(100vh - 150px); /* Ajustez la hauteur selon la hauteur de votre en-tête et bouton touiter */
        overflow-y: auto; /* Activez le défilement pour les posts uniquement */
    }
</style>
