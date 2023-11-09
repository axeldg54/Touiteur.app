<?php

declare(strict_types=1);
namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\list\ListAuteur;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
use \iutnc\deefy\image\Image;
use \DateTime;
use \iutnc\deefy\tag\Tag;


class ActionSelectTag extends Action{

    private int $valSelect;


    public function __construct(int $val){
        $this->valSelect = $val;
    }

    public function execute(): string {
        $db = ConnectionFactory::makeConnection();               

        $lt = new ListTouite();
        
        $st = $db->prepare(Touite::$query . " where tag.idtag=? ");
        $st->execute([$this->valSelect]);
        $nb = 0;
        while($row = $st->fetchAll()){
            // Récupéré tous les tags associé dans une liste
            $tabTags = Tag::recupererTags($row[$nb]["idTouite"]);
            $t = new Touite($row[$nb]["texte"], $row[$nb]["nom"],
            new Image($row[$nb]["imgd"], "img/what.png"),
            $row[$nb]["nblike"], new DateTime($row[$nb]["date"]), $tabTags);  
            $lt->addTouite($t);
        }  
        return $lt->displayListeTouites();
    }
}