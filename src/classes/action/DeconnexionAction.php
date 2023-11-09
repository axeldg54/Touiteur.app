<?php

namespace iutnc\deefy\action;

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\inscription\inscr;

class DeconnexionAction extends Action{

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = include 'modele/deconnexion.php';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (inscr::deconnexion()) {
                $htmlContent = include 'modele/deconnexionMessage.php';
                $_SESSION['user'] = null;
            }
        }
        return $htmlContent;
    }

}