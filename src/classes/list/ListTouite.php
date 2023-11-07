<?php

declare(strict_types=1);
namespace iutnc\deefy\list;

use \iutnc\deefy\Touite\Touite;
use \iutnc\deefy\tri\Tri;

/*Classe contient une */
class ListTouite{

/*Déclarations des attributs*/
    protected array $tabTouites;

/*Constructeur de la classe ListeTouite initialise la liste de Touite*/
    public function __construct(){$this->tabTouites = array();}


    /** Ajoute un Touite à la liste
     * @param $touite un Touite
     */
    public function addTouite(Touite $touite) : void{
        array_push($this->tabTouites, $touite);
        $this->trierTouites();
    }


    /**Supprime un Touite de la liste
    @param $touite un Touite*/
    public function suppTouites(Touite $touite) : void{
        foreach($this->tabTouites as $key => $val){
            if($val->__get("auteur") === $touite->__get("auteur")
            && $val->__get("titre") === $touite->__get("titre")){
                unset($this->tabPistes[$key]);
            }
        }
    }


    public function trierTouites() : void{
        Tri::tri($this->tabTouites);
    }
}
