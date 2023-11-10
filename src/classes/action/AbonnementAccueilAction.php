<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\touite\Touite;

class AbonnementAccueilAction extends Action{
    private string $idTouite;

    public function __construct($id)
    {
        $this->idTouite = $id;
    }

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;

            echo $this->idTouite;
            // connexion bd
            $pdo = ConnectionFactory::makeConnection();

            // recuperation de l'idUser de l'auteur du tweet
            $query = "select idUser from publier where idTouite = ?";
            $st = $pdo->prepare($query);
            $st->execute([$this->idTouite]);
            $row = $st->fetch();
            $idUser = $row['idUser'];

            // regarde si pas deja abonné
            $query = "select idUser from suivre where idUser = ? and idUser2 = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$idUser]);
            $row = $st->fetch();
            if ($st->rowCount() > 0) {
                Dispatcher::$refus = "Vous êtes déjà abonné";
                $possible = false;
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$refus = "";
                Dispatcher::$accept = "Vous êtes maintenant abonné";
                // insertion dans suivre
                $query = "insert into suivre(idUser, idUser2) values(?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $idUser]);
            }
        }
        return include "modele/user.php";
        }

}