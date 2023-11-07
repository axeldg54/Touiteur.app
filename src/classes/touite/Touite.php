<?php

declare(strict_types=1);
namespace iutnc\deefy\touite;

use \DateTime;
use iutnc\deefy\image\Image;
use \iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\tag\Tag;


/*Classe représentant un Touite*/
class Touite{

/*Déclarations des attributs*/
    private string $texte, $auteur, $titre;
    private int $score;
    private DateTime $date;
    private Image $image;
    private array $tags;


    /**
    Constructeur de la classe Touite
    @param $texte texte du touite
    @param $auteur auteur du touite
    @param $titre titre du touite
     */
    public function __construct(string $texte, string $auteur, string $titre, Image $i){
        $this->texte = $texte;
        $this->score = 0;
        $this->auteur = $auteur;
        $this->date = new DateTime();
        $this->titre = $titre;
        $this->image = $i;
        $this->tags[] = [];
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

}
