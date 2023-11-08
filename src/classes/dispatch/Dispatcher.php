<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\ActionSelectTouite;
use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\initialisation\Initialisation;


class Dispatcher {
    private string $action;
    private string $value;
    public static string $html= "";
    public static string $tweets="";
    public static string $selectTouite="";
    public static string $selectAuteur="";
    
    
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = '';
        if (isset($_GET["value"])) $this->value = $_GET["value"];
        else $this->value = '';
    }

    public function run() {
        switch ($this->action) {
            case "sign-in" :
                Dispatcher::$html = (new SignInAction)->execute();
                break;
            case "register" :
                Dispatcher::$html = (new AddUserAction)->execute();
                break;
            case "add-touite" :
                Dispatcher::$tweets = (new AddTouiteAction())->execute();
                break;
            case "liste-touite":
                Dispatcher::$tweets = (new ActionSelectTouite($this->value))->execute();
                Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();  
                Dispatcher::$html = include 'modele/accueil.php';
                break;   
            case "liste-auteur":
                Dispatcher::$tweets = (new ActionSelectTouite($this->value))->execute();
                Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();  
                Dispatcher::$selectAuteur = Initialisation::initialiserSelectAuteur();  
                Dispatcher::$html = include 'modele/accueil.php';
                break;                
            default :
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
        };
        $this->renderPage();
    }

    private function renderPage() : void {
        echo Dispatcher::$html;
    }
}
