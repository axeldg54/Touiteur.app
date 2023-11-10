<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;

class AddTagAccueilAction extends Action {

    private int $idTouite;

    public function __construct($id)
    {
        $this->idTouite = $id;
    }

    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;

            // Connexion à la base de données
            $pdo = ConnectionFactory::makeConnection();

            // Récupération des tags
            $query = "SELECT idTag FROM contient WHERE idTouite = ?";
            $st = $pdo->prepare($query);
            $st->execute([$this->idTouite]);
            $rows = $st->fetchAll();

            // Les stocker dans une liste
            $idTagList = array();
            foreach ($rows as $row) {
                $idTagList[] = $row['idTag'];
            }

            // Parcourir la liste des tags
            foreach ($idTagList as $idTag) {
                // Regarder si l'utilisateur n'est pas déjà abonné au tag
                $query = "SELECT idUser FROM abonnement WHERE idUser = ? AND idTag = ?";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $idTag]);

                if ($st->rowCount() > 0) {
                    Dispatcher::$refus = "Vous êtes déjà abonné au tag $idTag";
                    $possible = false;
                } else {
                    // Insertion dans la table abonnement
                    $query = "INSERT INTO abonnement(idUser, idTag) VALUES (?, ?)";
                    $st = $pdo->prepare($query);
                    $st->execute([$_SESSION['user']['id'], $idTag]);
                }
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$accept = "Vous êtes maintenant abonné aux tags";
                Dispatcher::$refus = "";
            }
        }
        return include "modele/user.php";
    }

}