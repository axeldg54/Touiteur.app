<?php

namespace iutnc\deefy\action;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\inscription\inscr;

/**
 * Gestion de l'incription d'un utilisateur
 */
class SignInAction extends Action {

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/connexion.php';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            if (inscr::authenticate($email, $password)) {
                Dispatcher::$refus = "";
                $htmlContent = include 'modele/user.php';
            }
            else { // Si un des identifiants est incorrecte
                Dispatcher::$refus = "mot de passe ou email incorrect";
                $htmlContent = include 'modele/connexion.php';
            };
        }
        return $htmlContent;
    }
}
