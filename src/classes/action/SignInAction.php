<?php

namespace iutnc\deefy\action;
use iutnc\deefy\inscription\inscr;

class SignInAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/connexion.php';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            if (inscr::authenticate($email, $password)) {
                $htmlContent = include 'modele/user.php';
            }
            else $htmlContent = include 'modele/connexionRefus.php';
        }
        return $htmlContent;
    }
}
