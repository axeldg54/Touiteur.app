<?php
require_once 'vendor/autoload.php';
use \iutnc\deefy\dispatch\Dispatcher;
use \iutnc\deefy\db\ConnectionFactory;

ConnectionFactory::setConfig('conf/connexion.ini');
$tweets = Dispatcher::$tweets;
$selectTouite = Dispatcher::$selectTouite;
$selectAuteur = Dispatcher::$selectAuteur;
$selectTag = Dispatcher::$selectTag;

echo <<< FIN
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
   <h1 class="title-container">
        <span>Touiteur</span>
        <img src="img/plume.svg" alt="Logo" class="logo">
    </h1>
    <!-- Déroulement de la liste des touites -->
    $selectTouite

    <!-- Déroulement de la liste des auteurs -->
    $selectAuteur

    <!-- Déroulement de la liste des auteurs -->
    $selectTag
</div>
<!-- sidebar fin -->


<!-- feed debut -->
<div class="container">
<div class="feed">

    <div class="feed__static">

        <div class="feed__header">
            <h2><a href="?action=accueil" class="header-link">Accueil</a></h2>
        </div>

    </div>
    <!-- feed__static fin -->
    
 <!-- touitebox debut -->
        <div class="tweetBox">
            <!--<a href="?action=add-touite" class="btn-touiter">Touiter</a>-->
            
            <form id="form" method="POST" action="index.php?action=add-touite" enctype="multipart/form-data">
              <div class="tweetbox__input">
                <img src ="img/user.png" alt=""/>
                   <textarea id="contenu" name="contenu" placeholder="Quoi de neuf ?" required></textarea>
                  <input type="file" id="file" name="file">
              </div>
            
                <input type="submit" value="Toutier" class="tweetBox__tweetButton" placeholder="Touite">
            </form>

        </div>
    <!-- touite box fin -->

    <div class="posts__container">        
        $tweets
    </div>
    <!-- posts__container fin -->
   
</div>
</div>

<!-- feed fin -->

    <!-- widgets debut -->
    <div class="widgets">
        <div class="widgets__loginButtons">
            <a href="?action=sign-in" class="loginButton">Connexion</a>
            <a href="?action=register" class="loginButton">Inscription</a>
            <a href="?action=user" class="loginButton">Profil</a>
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
    display: flex;
    height: 100vh; 
    max-width: 1300px;
    margin-left: auto;
    margin-right: auto;
    padding: 0 10px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f4f8; 
    color: #333;
    line-height: 1.6;
}

.header-link {
    text-decoration: none; 
    color: inherit; 
    font-weight: inherit; 
    }

  
   .tweetBox {
  display: flex;
  flex-direction: column;
  padding: 20px;
  border-bottom: 1px solid #e6ecf0;
}
   
      .post__body {
        flex: 1;
        padding: 10px;
        background-color: #FFFDFF;
         border-bottom: 1px solid #e6ecf0;
    }

   .sidebarOption {
    display: flex;
    align-items: center;
    padding: 10px;
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
        background-color: #EEFFF9;
        border-radius: 30px;
        color: var(--twitter-color);
        transition: color 100ms ease-out;
    }

    .sidebar__tweet {
        width: 100%;
        border: none;
        color: white;
        font-weight: 900;
        border-radius: 30px;
        height: 50px;
        margin-top: 20px;
    }
    
   .container {
    display: flex;
    justify-content: space-between;
    margin: auto;
    max-width: 1300px;
    padding: 0 20px;
}

    .sidebar {
    width: 250px; 
    margin-top: 20px;
    display: flex; 
    flex-direction: column; 
    align-items: center;
    justify-content: start; 
}

    .fa-twitter {
        color: var(--twitter-color);
        font-size: 30px;
    }

    .feed {
    flex: 1;
    margin: 0 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
  
    .feed__header {
    border-bottom: 1px solid #e6ecf0;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 1000;
}
    .feed__header h2 {
      color: #444;
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px; 
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
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

 
    .tweetBox form {
        display: flex;
        flex-direction: column;
    }

    .tweetbox__input {
        display: flex;
        padding: 20px;
    }
    
    .tweetbox__input textarea {
  flex: 3; 
  margin-right: 20px; 
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ddd; 
  border-radius: 4px; 
  height: 100px;
}


    .tweetbox__input input {
        flex: 2;
        font-size: 15px;
        border: none;
        outline: none;
    }

    .post__avatar img {
        border-radius: 50%;
        height: 40px;
    }

    .post {
padding: 20px;
border-bottom: 1px solid #e6ecf0;
}

    .post__body img {
        width: 450px;
        object-fit: contain;
        border-radius: 20px;
    }

    .post__footer {
display: flex;
justify-content: space-between;
font-size: 15px;
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
margin: 0;
}

   .post__headerDescription {
margin-bottom: 10px;
font-size: 15px;
color: #555;
}

  
    .post__avatar {
margin-right: 10px;
}


    /* widgets */
    .widgets {
    width: 250px;
    margin-top: 20px;
}
    .widgets__input {
        display: flex;
        align-items: center;
        background-color: var(--twitter-background);
        padding: 10px;
        border-radius: 20px;
        margin-top: 10px;
        margin-left: 0;
        align-self: flex-start; 
    }

    .widgets__input input {
        border: none;
        background-color: var(--twitter-background);
        flex: 1;
    }

    .widgets__searchIcon {
        color: gray;
    }

 .widgets__widgetContainer {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
    padding: 20px;
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
    
   a {
    color: #5D3FD3;
    text-decoration: none;
}
.sidebar h1 {
    background-color: #5D3FD3;
    color: #ffffff; 
    margin-bottom: 1rem;
    padding: 10px;
    border-radius: 20px;
    text-align: center;
    font-size: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: background-color 0.2s ease-in-out;
    width: 80%;
}

.sidebar h1:hover {
    background-color: #4a31c3;
}
.sidebar h1 img {
  height: 28px;
}
 
    /* styliser les boutons */
    .loginButton {
    padding: 10px 20px;
    margin-right: 10px; 
    border: 2px solid transparent;
    color: white;
    background-color: #7B725B; 
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;
        background-color: #E5D4A9;
        color: #544A42;
        margin-bottom: 10px;
    
}

.userButton, .tweetBox__tweetButton, .loginButton {
    background-color: #5D3FD3;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s ease;
}


.userButton:hover, .tweetBox__tweetButton:hover, .loginButton:hover {
    background-color: #4a31c3;
}

.widgets {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-end; 
    position: sticky;
    top: 0; 
    padding-top: 20px;
    height: 100vh;
    z-index: 1000;
}

    .widgets__loginButtons {
    display: flex;
    flex-direction: column;
    align-items: center;
    top: 0;
    padding-right: 20px; 
    z-index: 10;
        margin-right: 80px;
        
}

    .widgets__widgetContainer {
        margin-top: 15px;
        margin-left: 0; 
        padding: 20px;
        background-color: #f5f8fa;
        border-radius: 20px;
        align-self: flex-start;
    }
    
    input[type="text"], input[type="email"], input[type="file"], input[type="submit"] {
padding: 10px;
margin-bottom: 10px;
border: 1px solid #ddd;
border-radius: 4px;
width: 100%;
box-sizing: border-box;
}

input[type="submit"] {
background-color: #5D3FD3;
color: white;
cursor: pointer;
transition: background 0.3s ease;
}

input[type="submit"]:hover {
background-color: #4a31c3;
}

@media (max-width: 768px) {
.container {
flex-direction: column;
align-items: center;
}

.sidebar, .widgets {
    width: 100%;
    margin-bottom: 1rem;
}

.feed {
    order: -1; 
    width: 100%;
}


    .posts__container::-webkit-scrollbar {
    display: none; 
}

.posts__container {
    max-height: 600px; 
    overflow-y: scroll;
}


   
</style>
FIN;