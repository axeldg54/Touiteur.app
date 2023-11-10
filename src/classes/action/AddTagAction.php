<?php

namespace iutnc\deefy\action;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

/**
 * Gestion d'ajout d'un tag
 */
class AddTagAction extends Action {

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $possible = true;
            // connexion bd
            $pdo = ConnectionFactory::makeConnection();
            $tag = $_POST['tag'];
            $idTag = "";

            // regarde si tag existe
            $query = "select idTag from tag where libelle = ?";
            $st = $pdo->prepare($query);
            $st->execute([$tag]);
            $row = $st->fetch();
            if ($st->rowCount() < 1) {
                Dispatcher::$refus = "Le tag $tag n'existe pas";
                $possible = false;
            }
            else $idTag = $row['idTag'];

            // regarder si pas déjà abonné au tag
            $query = "select idUser from abonnement where idUser = ? and idTag = ?";
            $st = $pdo->prepare($query);
            $st->execute([$_SESSION['user']['id'],$idTag]);
            $row = $st->fetch();
            if ($st->rowCount() > 0) {
                Dispatcher::$refus = "Vous êtes déja abonné à au tag $tag";
                $possible = false;
            }

            if (!$possible) {
                Dispatcher::$accept = "";
                return include "modele/user.php";
            } else {
                Dispatcher::$accept = "Vous êtes maintenant abonné au tag $tag";
                Dispatcher::$refus = "";
                // insertion dans suivre
                $query = "insert into abonnement(idUser, idTag) values(?,?)";
                $st = $pdo->prepare($query);
                $st->execute([$_SESSION['user']['id'], $idTag]);
            }
        }
        return include "modele/user.php";
    }
}