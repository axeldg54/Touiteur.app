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
class ListTouite{

/*Déclarations des attributs*/
    protected array $tabTouites;

    public static string $query = "select t.idTouite as idTouite, 
    texte, nom, i.description as imgd, chemin,
     nblike, date from touite t inner join image i 
     on t.idImage = i.idImage inner join publier p 
     on t.idTouite = p.idTouite inner join utilisateur u on p.iduser = u.idUser
     inner join contient c on c.idtouite = t.idTouite inner join tag 
     on c.idTag = tag.idTag inner join likes on u.idUser = likes.idUser ";

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


    public static function recupererListeTouites(int $nbTouite) : ListTouite{
        $db = ConnectionFactory::makeConnection();               

        // Requête 1: récupère les informations de la table touite
        $st = $db->prepare(self::$query . " order by t.idTouite desc");
        $st->execute();

        $nb = 0;              
        $lt = new ListTouite();
        // Récupéré les 2 derniers tweets enregistrer dans la base de donnée
        while(($row = $st->fetchAll())){
            while($nb < $nbTouite){
                // Récupéré tous les tags associé dans une liste
                    $tabTags = Tag::recupererTags($row[$nb]["idTouite"]);
                $t = new Touite($row[$nb]["texte"], $row[$nb]["nom"],
                new Image($row[$nb]["imgd"], "img/what.png"),
                    $row[$nb]["nblike"], new DateTime($row[$nb]["date"]), $tabTags);                    
            $nb++;
            $lt->addTouite($t);
            }
        }
        return $lt;
    }

    public function selectListeTouite(int $nbTouite){
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un touite</option>
        Fin;

        $nb = 0;
        while($nb < $nbTouite){
            // Récupère les touites qui possède un certains tags
            $st = $db->prepare(self::$query . " where t.idTouite = ?");
            $st->execute([$nb]);
            $nb++;
            $html .= "<option value=?action=" . "liste-touite" ."> touite $nb </option>";            
        }
        $html .= "    
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
            </select>
            </div>";
        return $html;
    }
}
