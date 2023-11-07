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
                $htmlContent = include 'modele/accueil.php';
        };
        $this->renderPage($htmlContent);
    }

    private function renderPage(string $html) : void {
        echo $html;
    }
}
