<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AbonnementAccueilAction;
use iutnc\deefy\action\AbonnementAction;
use iutnc\deefy\action\AddTagAction;
use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\DeconnexionAction;
use iutnc\deefy\action\DesabonnementAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\SupTagAction;
use iutnc\deefy\action\ActionSelect;
use iutnc\deefy\initialisation\Initialisation;



class Dispatcher {
    private string $action;
    private string $value;
    public static string $html= "";
    public static string $tweets="";
    public static string $selectTouite="";
    public static string $selectAuteur="";
    public static string $refus = "";
    public static string $accept = "";
    public static string $selectTag="";
    private int $idTouite;


    
    public function __construct() {
        if (isset($_GET['action'])) $this->action = $_GET['action'];
        else $this->action = '';
        if (isset($_GET["value"])) $this->value = $_GET["value"];
        else $this->value = '';
        if (isset($_GET["idTouite"])) {
            $this->idTouite = $_GET["idTouite"];
        }
        else $this->idTouite = 0;
        
    }


    public function run() {
        // Initialisation des listes select
        Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();
        Dispatcher::$selectAuteur = Initialisation::initialiserSelectAuteur();  
        Dispatcher::$selectTag = Initialisation::initialiserSelectTag();
        switch ($this->action) {
            case "sign-in" :
                Dispatcher::$html = (new SignInAction)->execute();               
                break;
            case "register" :
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = (new AddUserAction)->execute();             
                break;
            case "add-touite" :
                Dispatcher::$html = (new AddTouiteAction())->execute();
                break;
            case "liste-touite":
                Dispatcher::$tweets = (new ActionSelect($this->value, " where u.idUser=? "  ))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;   
            case "liste-auteur":
                Dispatcher::$tweets = (new ActionSelect($this->value, " where u.idUser=? "  ))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "user-sub":
                Dispatcher::$html = (new AbonnementAction())->execute();
                break;
            case "sub-accueil":
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html= (new AbonnementAccueilAction($this->idTouite))->execute();
                break;
            case "user-unsub":
                Dispatcher::$html = (new DesabonnementAction())->execute();
                break;
            case "user":
                Dispatcher::$html = include "modele/user.php";
                break;
            case "user-addtag":
                Dispatcher::$html = (new AddTagAction())->execute();
                break;
            case "user-suptag":
                Dispatcher::$html = (new SupTagAction())->execute();
                break;
            case "liste-tag":
                Dispatcher::$tweets = (new ActionSelect($this->value, " where tag.idtag=? "))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "deconnexion":
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = (new DeconnexionAction())->execute();
                break;
            case "accueil":
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = include 'modele/accueil.php';
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
