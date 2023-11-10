<?php

namespace iutnc\deefy\action;

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\inscription\inscr;
use iutnc\deefy\initialisation\Initialisation;

class DeconnexionAction extends Action{

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/deconnexion.php';
            
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_SESSION['user']['id'] === -1){
                $htmlContent = include 'modele/accueil.php';
                
            }else{
                if (inscr::deconnexion()) {                    
                    $_SESSION['user']['id'] = -1;
                    $_SESSION['user']['nom'] = ' ';
                    $_SESSION['user']['prenom'] = ' ';
                    Dispatcher::$tweets = Initialisation::initialiser_Touites();
                    $htmlContent = include 'modele/accueil.php';
                }
            }
        }
        return $htmlContent;
    }

}