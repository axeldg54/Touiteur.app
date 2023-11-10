<?php
declare(strict_types=1);

namespace iutnc\deefy\initialisation;
use iutnc\deefy\list\ListAuteur;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\list\ListTag;

/**
 * Classe qui va initialiser des valeurs par défaults sur le site web 
 * des touites et des listes contenant des touites
 */
class Initialisation{

    
    /**
     * Méthode qui va initialiser des tweets au démarrage de l'application
     * @return string code correspondant à l'affichage des touites récupéré dans la bd
     */
    public static function initialiser_Touites() : string{
        $lt = ListTouite::recupererListeTouites(3);
        return $lt->displayListeTouites();
    }


    /**
     * Va initialiser le input des selects pour les différents touites
     * @return string contenant le code html des <input select>
     */
    public static function initialiserSelectTouite() : string{
        $selectListeTouite = ListTouite::selectListeTouite(8);
        return $selectListeTouite;
    }

     /**
     * Va initialiser le input des selects pour les différents auteurs
     * @return string contenant le code html des <input select>
     */
    public static function initialiserSelectAuteur() : string{
        $selectListeAuteur = ListAuteur::selectListeTouite(8);
        return $selectListeAuteur;
    }

     /**
     * Va initialiser le input des selects pour les différents tags
     * @return string contenant le code html des <input select>
     */
    public static function initialiserSelectTag() : string{
        $selectListeTag = ListTag::selectListeTouite(8);
        return $selectListeTag;
    }
}
