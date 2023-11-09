<?php

namespace iutnc\deefy\action;

use iutnc\deefy\tag\Tag;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;

class AddTouiteAction extends Action
{

    public function execute(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // insertion de l'image
            $idImage = Image::insertImage();
            // insertion du touite
            $idTouite = Touite::insertTuite($idImage);
            // insertion du tag
            Tag::insertTag($idTouite);

            $htmlContent = Initialisation::initialiser_Touites();
        }
        $lt = ListTouite::recupererListeTouites(3);
        Dispatcher::$tweets = $lt->displayListeTouites($lt);
        return include 'modele/accueil.php';
    }
}