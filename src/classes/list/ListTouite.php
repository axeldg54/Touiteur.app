<?php

declare(strict_types=1);
namespace iutnc\deefy\list;

use \iutnc\deefy\Touite\Touite;
use \iutnc\deefy\exception\InvalidPropertyNameException;
use \iutnc\deefy\tri\Tri;
use iutnc\deefy\initialisation\Initialisation;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\render\RendererTouite;



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
        $this->tabTouites = Tri::tri($this->tabTouites);
    }

   
    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

    
    public function displayListeTouites(ListTouite $lt) : string{ 
        $html = "";
        foreach($lt->__get("tabTouites") as $key => $val){
            $html .= (new RendererTouite($val))->render(Renderer::LONG);
        }
        return $html;
    }

}
