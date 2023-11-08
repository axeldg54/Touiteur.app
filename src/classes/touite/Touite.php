<?php

declare(strict_types=1);
namespace iutnc\deefy\touite;

use \DateTime;
use iutnc\deefy\image\Image;
use \iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\db\ConnectionFactory;


/*Classe représentant un Touite*/
class Touite{

/*Déclarations des attributs*/
    private string $texte, $auteur, $titre;
    private int $score;
    private DateTime $date;
    private Image $image;
    private array $tags;
    public static string $query = "select t.idTouite as idTouite, 
    texte, nom, i.description as imgd, chemin,
     nblike, date from touite t inner join image i 
     on t.idImage = i.idImage inner join publier p 
     on t.idTouite = p.idTouite inner join utilisateur u on p.iduser = u.idUser
     inner join contient c on c.idtouite = t.idTouite inner join tag 
     on c.idTag = tag.idTag inner join likes on u.idUser = likes.idUser ";


    /**
    Constructeur de la classe Touite
    @param $texte texte du touite
    @param $auteur auteur du touite
    @param $titre titre du touite
     */
    public function __construct(string $texte, string $auteur, Image $i, int $score, DateTime $date, array $tags){                        
        $this->texte = $texte;
        $this->score = $score;
        $this->auteur = $auteur;
        $this->date = $date;
        $this->image = $i;
        $this->tags = $tags;
    }
    

    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

    public function addTag(Tag $t) {
        array_push($this->tags, $t);
    }

    public function getTags() : array {
        return $this->tags;
    }


    public static function recupererTouite(int $nb) : Touite{
        $db = ConnectionFactory::makeConnection();               

        // Requête 1: récupère les informations de la table touite
        $st = $db->prepare(self::$query . " order by t.idTouite desc");
        $st->execute();

        $row = $st->fetchAll();            
        // Récupéré tous les tags associé dans une liste
        $tabTags = Tag::recupererTags($row[$nb]["idTouite"]);
        $t = new Touite($row[$nb]["texte"], $row[$nb]["nom"],
            new Image($row[$nb]["imgd"], "img/what.png"),
            $row[$nb]["nblike"], new DateTime($row[$nb]["date"]), $tabTags);                    
        return $t; 
    }
}
