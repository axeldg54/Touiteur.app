<?php

declare(strict_types=1);
namespace iutnc\deefy\list;


use \iutnc\deefy\Touite\Touite;
use \iutnc\deefy\exception\InvalidPropertyNameException;
use \iutnc\deefy\tri\Tri;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\render\RendererTouite;
use iutnc\deefy\db\ConnectionFactory;




/*Classe contient une */
class ListTouite{

/*Déclarations des attributs*/
    protected array $tabTouites;

    public static bool $ISSELECT=false;


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


    /**
     * Tri la liste de touite
     */
    public function trierTouites() : void{
        $this->tabTouites = Tri::tri($this->tabTouites);
    }

    
    

    /**
     * Affiche la liste des touites
     */
    public function displayListeTouites() : string{
        $html = "";
        foreach($this->tabTouites as $key => $val){
            $render = Renderer::LONG;
            /**
            // Vérifier si $_SESSION['user'] est défini et si la clé "id" existe
                if(ListTouite::$ISSELECT or $_SESSION['user']["id"] !== -1){
                    $render = Renderer::LONG;
                    ListTouite::$ISSELECT = false;
                }*/

            $html .= (new RendererTouite($val))->render($render);
        }
        return $html;
    }


    /**
     * Récupère la liste des touites
     * @return ListTouite une liste de touite
     */
    public static function recupererListeTouites(int $nbTouite) : ListTouite{
        $nb = 0;
        $lt = new ListTouite();
        while($nb < $nbTouite){
            $lt->addTouite(Touite::recupererTouite($nb));
            $nb++;
        }
        return $lt;
    }


    /**
     * Initialise la liste des touites dans la liste déroulante
     */
    public static function selectListeTouite(int $nbTouite){

        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un touite</option>
        Fin;

        $nb = 0;
        // $nbTouite prend la valeur max du nombre de touite
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
