<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

/**
 * Gestion abonnement 
 */
class AbonnementAccueilAction extends Action{

    /**
     * Déclarations des attributs
     */
    private string $idTouite;

    /**
     * Constructeur initialise la valeur de l'idTouite récupérer via l'URL
     */
    public function __construct($id)
    {
        $this->idTouite = $id;
    }


    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;
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