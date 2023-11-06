<?php

declare(strict_types=1);
namespace iutnc\deefy\touite;

use \DateTime;
use iutnc\deefy\Image\Image;


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

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getScore(): int
    {
        return $this->score;
    }

}
