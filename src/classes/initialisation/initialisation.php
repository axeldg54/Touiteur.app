<?php
declare(strict_types=1);

namespace iutnc\deefy\initialisation;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\list\ListTouite;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;
use \iutnc\deefy\image\Image;
use \DateTime;


/**
 * Classe qui va initialiser des valeurs par défaults sur le site web
 */
class Initialisation{

    public static string $query = "select t.idTouite as idTouite, 
    texte, nom, i.description as imgd, chemin,
     nblike, date from touite t inner join image i 
     on t.idImage = i.idImage inner join publier p 
     on t.idTouite = p.idTouite inner join utilisateur u on p.iduser = u.idUser
     inner join contient c on c.idtouite = t.idTouite inner join tag 
     on c.idTag = tag.idTag inner join likes on u.idUser = likes.idUser ";

     
    /**
     * Méthode qui va initialiser 2 tweets au démarrage de l'application
     */
    public static function initialiser_Touites() : string{
        $db = ConnectionFactory::makeConnection();               

        // Requête 1: récupère les informations de la table touite
        $st = $db->prepare(self::$query);
        $st->execute();

        $nb = 0;              
        $lt = new ListTouite();
        // Récupéré les 2 derniers tweets enregistrer dans la base de donnée
        while(($row = $st->fetchAll())){
            while($nb < 2){
                // Récupéré tous les tags associé dans une liste
            $tabTags = Tag::recupererTags($row[$nb]["idTouite"]);
            
            $t = new Touite($row[$nb]["texte"], $row[$nb]["nom"],
                new Image($row[$nb]["imgd"], "img/what.png"),
                    $row[$nb]["nblike"], new DateTime($row[$nb]["date"]), $tabTags);                    
            $nb++;
            // "/img/".$row[$nb]["chemin"]
            //echo "img/what.png";
            $lt->addTouite($t);
            }
        }
        return $lt->displayListeTouites($lt);
    }


    /**
     * Va initialiser le input des selects pour les différents touites
     * @return string contenant le code html des <input select>
     */
    public static function initialiserSelectTouite() : string{
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un touite</option>
        Fin;

        $nb = 0;
        while($nb < 2){
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
        

        // Mettre dans une liste le touite recupere et l afficher


        return $html;
    }
   
}