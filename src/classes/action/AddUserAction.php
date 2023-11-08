<?php

namespace iutnc\deefy\action;
use iutnc\deefy\exception\AuthException;
use iutnc\deefy\inscription\inscr;

class AddUserAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/inscription.php';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            // Ajouter filtrer pour password
            $password = $_POST['password'];

            try {
                if (inscr::register($nom,$prenom,$email, $password, 0)) $htmlContent = include 'modele/accueil.php';
                else $htmlContent = include 'modele/inscriptionRefus.php';
            } catch (AuthException $e) {
                echo $e;
            }
        }
        return $htmlContent;
    }
}
