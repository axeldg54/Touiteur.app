<?php

declare(strict_types=1);
namespace iutnc\deefy\list;

use \iutnc\deefy\Touite\Touite;
use \iutnc\deefy\exception\InvalidPropertyNameException;
use \iutnc\deefy\tri\Tri;
use \iutnc\deefy\tag\Tag;
use \iutnc\deefy\image\Image;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\render\RendererTouite;
use iutnc\deefy\db\ConnectionFactory;
use \DateTime;



/*Classe contient une */
class ListAuteur{

/*Déclarations des attributs*/
    protected array $tabAuteurs;


/*Constructeur de la classe ListeTouite initialise la liste de Touite*/
    public function __construct(){$this->tabAuteurs = array();}


    /** Ajoute un Auteur à la liste
     * @param $auteur 
     */
    public function addTouite(Touite $auteur) : void{
        array_push($this->tabAuteurs, $auteur);
        $this->trierTouites();
    }


    /**
    * Supprime un Auteur de la liste
    * @param $auteur 
    */
    public function suppTouites(Touite $auteur) : void{
        foreach($this->tabAuteurs as $key => $val){
            if($val->__get("email") === $auteur->__get("email")){
                unset($this->tabAuteurs[$key]);
            }
        }
    }


    public function trierAuteurs() : void{
        $this->tabAuteurs = Tri::tri($this->tabAuteurs);
    }

   
    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }

    
    public function displayListeAuteurs() : string{ 
        $html = "";
        foreach($this->tabTouites as $key => $val){
            $html .= (new RendererTouite($val))->render(Renderer::LONG);
        }
        return $html;
    }


    public static function recupererListeTouites(int $nbTouite) : ListTouite{
        $nb = 0;
        $lt = new ListTouite();
        while($nb < $nbTouite){
            $lt->addTouite(Touite::recupererTouite($nb));
            $nb++;
        }
        return $lt;
    }

    public static function selectListeTouite(int $nbTouite){
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un touite</option>
        Fin;

        $nb = 0;
        while($nb < $nbTouite){
            // Récupère les touites qui possède un certains tags
            $st = $db->prepare(Touite::$query . " where t.idTouite = ?");
            $st->execute([$nb]);
            $nb++;
            $html .= "<option value=?action=" . "liste-touite" ."&value=" . $nb."> touite $nb </option>";            
        }
        $html .= "    
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
            </select>
            </div>";
        return $html;
    }
}
