<?php

declare(strict_types=1);
namespace iutnc\deefy\touite;

use \DateTime;


/*Classe représentant un Touite*/
class Touite{

/*Déclarations des attributs*/
    private string $texte;
    private int $score;
    private string $auteur;
    private DateTime $date;
    private string $titre;


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
    }
}
