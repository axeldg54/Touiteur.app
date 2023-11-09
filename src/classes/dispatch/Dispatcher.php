<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\ActionSelectTouite;
use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\DeconnexionAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\ActionSelectAuteur;
use iutnc\deefy\action\ActionSelectTag;
use iutnc\deefy\initialisation\Initialisation;


class Dispatcher {
    private string $action;
    private string $value;
    public static string $html= "";
    public static string $tweets="";
    public static string $selectTouite="";
    public static string $selectAuteur="";
    public static string $selectTag="";
    
    
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = '';
        if (isset($_GET["value"])) $this->value = $_GET["value"];
        else $this->value = '';
    }


    public function run() {
        Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();
        Dispatcher::$selectAuteur = Initialisation::initialiserSelectAuteur();  
        Dispatcher::$selectTag = Initialisation::initialiserSelectTag();
        switch ($this->action) {
            case "sign-in" :
                Dispatcher::$html = (new SignInAction)->execute();                
                break;
            case "register" :
                Dispatcher::$html = (new AddUserAction)->execute();
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                break;
            case "add-touite" :
                Dispatcher::$html = (new AddTouiteAction())->execute();
                break;
            case "liste-touite":
                Dispatcher::$tweets = (new ActionSelectTouite($this->value))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;   
            case "liste-auteur":
                Dispatcher::$tweets = (new ActionSelectAuteur($this->value))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break; 
            case "liste-tag":
                Dispatcher::$tweets = (new ActionSelectTag($this->value))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "deconnexion":
                Dispatcher::$html = (new DeconnexionAction())->execute();
                break;    
            default :
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
        };
        $this->renderPage();
    }


    private function renderPage() : void {
        echo Dispatcher::$html;
    }
}
