<?php

declare(strict_types=1);
namespace iutnc\deefy\list;

use \iutnc\deefy\Touite\Touite;
use iutnc\deefy\db\ConnectionFactory;



/*Classe contient une */
class ListAuteur{

    
    public static function selectListeTouite(int $nbAuteur){
        // Connexion à la base de donnée
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">Selectionner un auteur</option>
        Fin;

        $nb = 0;
        // $nbAuteur prend la valeur max du nombre max d'auteur 
        while($nb < $nbAuteur){
            // Récupère les touites qui possède un certains tags
            $st = $db->prepare(Touite::$query . " where u.idUser = ?");
            $st->execute([$nb]);
            $nb++;
            $html .= "<option value=?action=" . "liste-auteur" ."&value=" . $nb."> auteur $nb </option>";            
        }
        $html .= "    
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
            </select>
            </div>";
        return $html;
    }

    /**
    public static function selectListeTouite(int $nbAuteur, string $titre, string $condition, string $action, String $nom){
        // Connexion à la base de donnée
        $db = ConnectionFactory::makeConnection();               
        $html = <<< Fin
        <div class="sidebarOption">
        <select id="tweets-dropdown" class="sidebar__dropdown" onchange="window.location.href=this.value">
            <option value="">$titre</option>
        Fin;

        $nb = 0;
        // $nbAuteur prend la valeur max du nombre max d'auteur 
        while($nb < $nbAuteur){
            // Récupère les touites qui possède un certains tags
            $st = $db->prepare(Touite::$query . $condition);
            $st->execute([$nb]);
            $nb++;
            $html .= "<option value=?action=" . $action ."&value=" . $nb."> $nom $nb </option>";            
        }
        $html .= "    
            <!-- ajout supplementaires si besoin (à configurer pour ajout automatique -->
            </select>
            </div>";
        return $html;
    }*/
}
