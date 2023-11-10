<?php

namespace iutnc\deefy\action;


use iutnc\deefy\likes\Likes;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;

/**
 * Gestion ajout d'un touite
 */
class AddTouiteAction extends Action
{

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        // Véirifie si l'user existe
        if ($_SESSION['user']['id'] >= 0) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // insertion de l'image
                $idImage = Image::insertImage();
                // insertion du touite
                $idTouite = Touite::insertTuite($idImage);
                // insertion du tag
                Tag::insertTag($idTouite);
                // Insertion Likes
                Likes::insertLikes($idTouite);
            }
            $lt = ListTouite::recupererListeTouites(3);
            Dispatcher::$tweets = Initialisation::initialiser_Touites();
            return include 'modele/accueil.php';
        } else{ // Si pas connecté envoie à la page inscription
            return include 'modele/inscription.php';
        }
    }
}