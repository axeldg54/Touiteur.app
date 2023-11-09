<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;

class DesabonnementAction extends Action {

    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;

            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            // get id avec email
            $email= $_POST['email2'];
            $query = "select idUser from utilisateur where email = ?";
            $st = $pdo->prepare($query);
            $st->execute([$email]);
            $row = $st->fetch();
            $id = $row['idUser'];

            // regarde si email existe
            $query = "select idUser from utilisateur where email = ?";
            $st = $pdo->prepare($query);
            $st->execute([$email]);
            $row = $st->fetch();
            if ($st->rowCount() < 1) {
                Dispatcher::$refus = "L'email $email n'existe pas";
                $possible = false;
            }

            // regarder si est bien déjà abonné
            $query = "select idUser from suivre where idUser = ? and idUser2 = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$id]);
            $row = $st->fetch();
            if ($st->rowCount() < 1) {
                Dispatcher::$refus = "Vous n'êtes pas encore abonné à $email";
                $possible = false;
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$refus = "";
                Dispatcher::$accept = "Vous êtes maintenant désabonné de $email";
                // insertion dans suivre
                $query = "delete from suivre where idUser = ? and idUser2 = ?";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $id]);
            }
        }
        return include "modele/user.php";
    }
}