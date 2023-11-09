<?php

namespace iutnc\deefy\action;


use iutnc\deefy\likes\Likes;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\inscription\inscr;

class AddTouiteAction extends Action
{

    public function execute(): string {
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
        } else{
            return include 'modele/inscription.php';
        }
    }
}