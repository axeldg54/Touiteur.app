<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\DeconnexionAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;


class Dispatcher {
    private string $action;
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = 'add-touite';
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
            case "liste-touite":
                $htmlContent =  "ici";
                break;
            case "deconnexion":
                $htmlContent = (new DeconnexionAction())->execute();
                break;
            default :
                $htmlContent = (new AddTouiteAction())->execute();
        };
        $this->renderPage($htmlContent);
    }

    private function renderPage(string $html) : void {
        echo $html;
    }

}
