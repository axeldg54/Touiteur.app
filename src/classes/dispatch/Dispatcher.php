<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\initialisation\Initialisation;


class Dispatcher {
    private string $action;
    public static string $html= "";
    public static string $tweets="";
    public static string $selectTouite="";
    
    
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = '';
    }

    public function run() {
        switch ($this->action) {
            case "sign-in" :
                Dispatcher::$html = (new SignInAction)->execute();
                //$htmlContent = (new SignInAction)->execute();
                break;
            case "register" :
                Dispatcher::$html = (new AddUserAction)->execute();
                //$htmlContent = (new AddUserAction)->execute();
                break;
            case "add-touite" :
                Dispatcher::$tweets = (new AddTouiteAction())->execute();
                //$htmlContent = (new AddTouiteAction())->execute();
                break;
            case "liste-touite":
                Dispatcher::$selectTouite = "ici";
                //$htmlContent =  "ici";
                break;                
            default :
                //$htmlContent = (new AddTouiteAction())->execute();
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
        };
        //$this->renderPage($htmlContent);
        $this->renderPage();
    }

    /**
    private function renderPage(string $html) : void {
        echo $html;
    }*/

    private function renderPage() : void {
        echo Dispatcher::$html;
    }
}
