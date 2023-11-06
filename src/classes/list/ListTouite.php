<?php

declare(strict_types=1);
namespace iutnc\deefy\list;

use \iutnc\deefy\Touite\Touite;

/*Classe contient une */
class ListTouite{

/*Déclarations des attributs*/
    protected array $tabTouites;

/*Constructeur de la classe ListeTouite initialise la liste de Touite*/
    public function __construct(){$this->tabTouites = array();}


/*Ajoute un Touite à la liste
@param $touite un Touite*/
    public function addTouites(Touite $touite) : void{
        array_push($this->tabTouites, $touite);}

    /**Supprime un Touite de la liste
    @param $touite un Touite*/
    public function suppTouites(Touite $touite) : void{
        foreach($this->tabTouites as $key => $val){
            if($val->)
        }
    }
}
