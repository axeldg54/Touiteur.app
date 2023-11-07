<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;

class Dispatcher {
    private string $action;
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = '';
    }

    public function run() {
        switch ($this->action) {
            case "sign-in" :
                $htmlContent = (new SignInAction)->execute();
                break;
            case "register" :
                $htmlContent = (new AddUserAction)->execute();
                break;
            case "add-touite" :
                $htmlContent = (new AddTouiteAction())->execute();
                break;
            default :
                $htmlContent = '<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Touiteur</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          />
  </head>
  <body>
    <div class="sidebar">

      <h1><center>Touite</center></h1>

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

      <button class="sidebar__tweet">Touite</button>
    </div>
    <!-- sidebar fin -->


    <!-- feed debut -->
    <div class="feed">
      <div class="feed__header">
          <h2>Accueil</h2>
      </div>

      <!-- touitebox debut -->
      <div class="tweetBox">
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
      </div>
      <!-- touite box fin -->

      <!-- post debut -->
      <div class="post">
        <div class="post__avatar">
          <img
            src ="images/user.png"
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
            src ="images/user.png"
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
</html>';
        };
        $this->renderPage($htmlContent);
    }

    private function renderPage(string $html) : void {
        echo $html;
    }
}
