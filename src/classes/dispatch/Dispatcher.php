<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AbonnementAccueilAction;
use iutnc\deefy\action\AbonnementAction;
use iutnc\deefy\action\AddTagAccueilAction;
use iutnc\deefy\action\AddTagAction;
use iutnc\deefy\action\AddTouiteAction;
use iutnc\deefy\action\DeconnexionAction;
use iutnc\deefy\action\DesabonnementAction;
use iutnc\deefy\action\SignInAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\SupTagAction;
use iutnc\deefy\action\ActionSelect;
use iutnc\deefy\initialisation\Initialisation;


/**
 * Dispatcher
 */
class Dispatcher {

    /**
     * Déclarations des attributs
     */
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


    /**
     * Constructeur du dispatcher initialise les query_string 
     */
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



    /**
     * Fonction qui va lancer les actions en fonction de la valeur du query string d'action
     */
    public function run() {
        // Initialisation des listes select
        Dispatcher::$selectTouite = Initialisation::initialiserSelectTouite();
        Dispatcher::$selectAuteur = Initialisation::initialiserSelectAuteur();  
        Dispatcher::$selectTag = Initialisation::initialiserSelectTag();
        switch ($this->action) {
            case "sign-in" :  // Cas s'inscrire
                Dispatcher::$html = (new SignInAction)->execute();               
                break;
            case "register" : // Cas se connecter
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = (new AddUserAction)->execute();             
                break;
            case "add-touite" : // Cas ajouter un touite
                Dispatcher::$html = (new AddTouiteAction())->execute();
                break;
            case "liste-touite": // Cas action click sur un touite
                Dispatcher::$tweets = (new ActionSelect($this->value, " where u.idUser=? "  ))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "liste-auteur":// Cas action click sur un auteur
                Dispatcher::$tweets = (new ActionSelect($this->value, " where u.idUser=? "  ))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "user-sub": // Cas suppression utilisateur suivi
                Dispatcher::$html = (new AbonnementAction())->execute();
                break;
            case "sub-accueil": // Cas abonnement utilisateur suivi
                Dispatcher::$html= (new AbonnementAccueilAction($this->idTouite))->execute();
                break;
            case "user-unsub":  // Cas suppression d'un utilisateur suivi
                Dispatcher::$html = (new DesabonnementAction())->execute();
                break;
            case "user":
                Dispatcher::$html = include "modele/user.php";
                break;
            case "user-addtag": // Cas ajout d'un tag depuis un touite
                Dispatcher::$html = (new AddTagAction())->execute();
                break;
            case "addtag-accueil": // Cas ajout un tag
                Dispatcher::$html = (new AddTagAccueilAction($this->idTouite))->execute();
                break;
            case "user-suptag": // Cas suppression d'un tag
                Dispatcher::$html = (new SupTagAction())->execute();
                break;
            case "liste-tag": // Cas action click sur un tag
                Dispatcher::$tweets = (new ActionSelect($this->value, " where tag.idtag=? "))->execute();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            case "deconnexion": // Cas pour la confirmation de la déconnexion
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html =(new DeconnexionAction())->execute();
                break;
            case "accueil": // Cas pour l'accueil
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
            default : // Cas de base s'il il n'y a pas d'action
                Dispatcher::$tweets = Initialisation::initialiser_Touites();
                Dispatcher::$html = include 'modele/accueil.php';
                break;
        };
        $this->renderPage();
    }


    /**
     * Affichage de la page html
     */
    private function renderPage() : void {
        echo Dispatcher::$html;
    }
}
