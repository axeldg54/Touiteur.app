<?php

declare(strict_types=1);
namespace iutnc\deefy\touite;

use \DateTime;
use iutnc\deefy\Image\Image;
use \iutnc\deefy\exception\InvalidPropertyNameException;


/*Classe représentant un Touite*/
class Touite{

/*Déclarations des attributs*/
    private string $texte;
    private int $score;
    private string $auteur;
    private DateTime $date;
    private string $titre;

    private Image $image;


    /**

    Constructeur de la classe Touite
    @param $texte texte du touite
    @param $auteur auteur du touite
    @param $titre titre du touite
     */
    public function __construct(string $texte, string $auteur, string $titre){
        $this->texte = $texte;
        $this->score = 0;
        $this->auteur = $auteur;
        $this->date = new DateTime();
        $this->titre = $titre;
    }

    

    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

}
