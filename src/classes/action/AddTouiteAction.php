<?php

namespace iutnc\deefy\action;

<<<<<<< HEAD
use DateTime;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\list\ListTouite;
=======
use iutnc\deefy\tag\Tag;
use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\image\Image;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
>>>>>>> 1f72b1aa8acf13ad87229cb62d6649c4c63713bd

class AddTouiteAction extends Action
{

<<<<<<< HEAD
    public function execute(): string
    {
        
=======
    public function execute(): string {
>>>>>>> 1f72b1aa8acf13ad87229cb62d6649c4c63713bd
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // insertion de l'image
            $idImage = Image::insertImage();
            // insertion du touite
            $idTouite = Touite::insertTuite($idImage);
            // insertion du tag
            Tag::insertTag($idTouite);

<<<<<<< HEAD
            // insertion dans publier
            $idUser = $_SESSION['user']['id'];
            $query = "insert into publier(idTouite,idUser,date) values(?,?,?)";
            $st = $pdo->prepare($query);
            $st->execute([$idTouite,$idUser,(new DateTime())->format("Y-m-d")]);
            
=======
            $htmlContent = Initialisation::initialiser_Touites();
>>>>>>> 1f72b1aa8acf13ad87229cb62d6649c4c63713bd
        }
        $lt = ListTouite::recupererListeTouites(3);
        Dispatcher::$tweets = $lt->displayListeTouites($lt);  
        return include 'modele/accueil.php';
    }
}