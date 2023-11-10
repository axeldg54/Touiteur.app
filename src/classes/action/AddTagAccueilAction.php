<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

/**
 * Gestion de l'ajout de tag
 */
class AddTagAccueilAction extends Action {

    /**
     * Déclaration des attributs
     */
    private int $idTouite;

    /**
     * Initialise l id du touite que l'on récupère dans l'url
     */
    public function __construct($id)
    {
        $this->idTouite = $id;
    }

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
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

            if (!$possible) {  // Si pas connecté
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else { // Si connecté
                Dispatcher::$accept = "Vous êtes maintenant abonné aux tags";
                Dispatcher::$refus = "";
            }
        }
        return include "modele/user.php";
    }

}