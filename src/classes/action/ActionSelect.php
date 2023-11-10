<?php

declare(strict_types=1);
namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
use \iutnc\deefy\image\Image;
use \DateTime;
use \iutnc\deefy\tag\Tag;

/**
 * Gère l'action lié au clic sur un touite d'une liste et retourne son affichage
 */
class ActionSelect extends Action{

    /**
     * Déclarations des attributs
     */
    private int $valSelect;
    private string $condition;


    /**
     * Constructeur de la classe ActionSelect
     * @param int id de l'élément dans la liste
     * @param string condition pour récupérer informations sur le touite dans la bd
     */
    public function __construct(int $val, string $condition){
        $this->valSelect = $val;
        $this->condition = $condition;
    }

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    public function execute(): string {
        // Connexion à la base de donnée
        $db = ConnectionFactory::makeConnection();               

        // Préparation de la requête
        $st = $db->prepare(Touite::$query . $this->condition);
        $st->execute([$this->valSelect]);
        $row = $st->fetchAll();  
        
        $nb = 0;
        // Récupéré tous les tags associé dans une liste
        $tabTags = Tag::recupererTags($row[$nb]["idTouite"]);

        // Récupère le touite
        $t = new Touite($row[$nb]["texte"], $row[$nb]["nom"],
            new Image($row[$nb]["imgd"], "img/what.png"),
            $row[$nb]["nblike"], new DateTime($row[$nb]["date"]), $tabTags);                    
        
        
        $lt = new ListTouite();
        $lt->addTouite($t); // Ajout touite dans une liste
        ListTouite::$ISSELECT = true;  // Valeur pour l'affichage en long dans renderer
        return $lt->displayListeTouites();
    }
}