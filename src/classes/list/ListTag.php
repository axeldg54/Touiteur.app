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
use \iutnc\deefy\user\User;



/*Classe contient une */
class ListTag{

  
    public function __get(string $attr) : mixed{
        if(!property_exists($this, $attr)){
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        }
        else{
            return $this->$attr;
        }
    }


    public static function selectListeTouite(int $nbTag){
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un tag</option>
        Fin;

        $nb = 0;
        // $nbTag prend la valeur max du nombre max de tag
        while($nb < $nbTag){
            // Récupère les touites qui possède un certains tags
            $st = $db->prepare(Touite::$query . " where tag.idtag = ?");
            $st->execute([$nb]);
            $nb++;
            $html .= "<option value=?action=" . "liste-tag" ."&value=" . $nb."> tag $nb </option>";            
        }
        $html .= "    
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
            </select>
            </div>";
        return $html;
    }


    public static function recupererTagsDansTouite(string $contenu) : array{
        $lettre = "";
        $tag = "";
        $tags = array();
        for ($i = strlen($contenu); $i > -1 ; $i--) {
            if (isset($contenu[$i])) $lettre = $contenu[$i];
            $tag .= $lettre;
            if ($lettre === "#") {
                array_push($tags, strrev($tag));
            }
            if ($lettre === " ") {
                $tag = "";
            }
        }
        if (count($tags) === 0){
            $tags[] = "#touiteur";
        }
        return $tags;
    }
}
