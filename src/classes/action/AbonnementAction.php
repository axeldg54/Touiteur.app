<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

/**
 * Gestion de l'Abonnement 
 */
class AbonnementAction extends Action {

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;
            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            // get id avec email
            $email= $_POST['email'];
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

            // regarder si pas déjà abonné
            $query = "select idUser from suivre where idUser = ? and idUser2 = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$id]);
            $row = $st->fetch();
            if ($st->rowCount() > 0) {
                Dispatcher::$refus = "Vous êtes déjà abonné à $email";
                $possible = false;
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$refus = "";
                Dispatcher::$accept = "Vous êtes maintenant abonné à $email";
                // insertion dans suivre
                $query = "insert into suivre(idUser, idUser2) values(?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $id]);
            }
        }
        return include "modele/user.php";
    }
}