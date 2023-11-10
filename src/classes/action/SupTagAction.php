<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

/**
 * Gestion de suppression d'un tag
 */
class SupTagAction extends Action {

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;

            // connexion bd
            $pdo = ConnectionFactory::makeConnection();
            $tag = $_POST['tag2'];
            $idTag = "";

            // regarde si tag existe
            $query = "select idTag from tag where libelle = ?";
            $st = $pdo->prepare($query);
            $st->execute([$tag]);
            $row = $st->fetch();
            if ($st->rowCount() < 1) {
                $possible = false;
                Dispatcher::$refus = "Le tag $tag n'existe pas";
            }
            else $idTag = $row['idTag'];

            // regarder si pas déjà abonné au tag
            $query = "select idUser from abonnement where idUser = ? and idTag = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$idTag]);
            $row = $st->fetch();
            if ($st->rowCount() < 1) {
                $possible = false;
                Dispatcher::$refus = "Vous n'êtes pas abonné au tag $tag";
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$accept = "Vous êtes maintenant désabonné du  tag $tag";
                Dispatcher::$refus = "";
                // insertion dans suivre
                $query = "delete from abonnement where idUser = ? and idTag = ?";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $idTag]);
            }
        }
        return include "modele/user.php";
    }
}