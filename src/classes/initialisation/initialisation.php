<?php
declare(strict_types=1);

namespace iutnc\deefy\initialisation;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;
use \iutnc\deefy\image\Image;
use \DateTime;
use \iutnc\deefy\exception\InvalidPropertyNameException;


/**
 * Classe qui va initialiser des valeurs par défaults sur le site web
 */
class Initialisation{

         
    /**
     * Méthode qui va initialiser des tweets au démarrage de l'application
     */
    public static function initialiser_Touites() : string{
        $lt = ListTouite::recupererListeTouites(3);
        return $lt->displayListeTouites($lt);
    }


    /**
     * Va initialiser le input des selects pour les différents touites
     * @return string contenant le code html des <input select>
     */
    public static function initialiserSelectTouite() : string{
        $selectListeTouite = (new ListTouite())->selectListeTouite(3);
        return $selectListeTouite;
    }
}