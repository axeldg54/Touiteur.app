<?php

namespace iutnc\deefy\action;

use iutnc\deefy\inscription\inscr;

class DeconnexionAction extends Action{

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/deconnexion.php';
            var_dump($_SESSION['user']);
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (inscr::deconnexion()) {
                $_SESSION['user']["id"] = -1;
                var_dump($_SESSION['user']);
                $htmlContent = include 'modele/deconnexionMessage.php';
            }
        }
        return $htmlContent;
    }

}