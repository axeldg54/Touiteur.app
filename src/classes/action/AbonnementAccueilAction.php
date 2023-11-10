<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\touite\Touite;

class AbonnementAccueilAction extends Action{

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;

            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            //recuperation de l'idUser de l'auteur du tweet

            $nom = Touite::__get("auteur");
            $query = "select idUser from utilisateur where nom = ";
            $st = $pdo->prepare($query);
            $id = $st->execute([$nom]);


            $query = "select idUser from suivre where idUser = ? and idUser2 = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$id]);
            $row = $st->fetch();
            if ($st->rowCount() > 0) {
                Dispatcher::$refus = "Vous êtes déjà abonné";
                $possible = false;
            }
            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/accueil.php";
            } else {
                Dispatcher::$refus = "";
                Dispatcher::$accept = "Vous êtes maintenant abonné";
                // insertion dans suivre
                $query = "insert into suivre(idUser, idUser2) values(?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $id]);
            }
        }
        return include "modele/accueil.php";
        }

}