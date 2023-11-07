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
            case "add-playlist" :
                $htmlContent = (new AddTouiteAction())->execute();
                break;
            default :
                $htmlContent = 'Bienvenue !';
        };
        $this->renderPage($htmlContent);
    }

    private function renderPage(string $html) : void {
        echo "<!DOCTYPE html>
        <html xml:lang='fr' lang='fr' dir='ltr'>
          <head>
            <title>Titre</title>
          </head>
          <body>
            <a href='?action='>accueil</a><br>
            <a href='?action=sign-in'>Connexion</a><br>
            <a href='?action=register'>Inscription</a><br>
            <a href='?action=add-touite'>Ajouter Touite</a><br>
            $html
          </body>
        </html>";
    }
}
