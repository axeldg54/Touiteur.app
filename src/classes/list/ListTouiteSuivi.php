<?php

namespace iutnc\deefy\list;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\tri\Tri;

/**
 * Représente la liste des touites que l'utilisateur suit
 */
class ListTouiteSuivi{

    /**
     * Déclarations des attributs
     */
    protected array $tabSuivi;

    /**
     * Initialise la liste des touites
     */
    public function __construct(){
        $this->tabSuivi =array();
    }


    /** Ajoute un Touite à la liste
     * @param $touite un Touite
     */
    public function addTouite(Touite $touite) : void{
        array_push($this->tabSuivi, $touite);
        $this->trierTouites();
    }

    /**
     * Tri la liste des touites suivis
     */
    public function trierTouites() : void{
        $this->tabSuivi = Tri::tri($this->tabSuivi);
    }

    /**
     * Récupère les touites suivis par l'utilisateur
     */
    public function recupererListeUtilisateurSuivi() : array{
        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare("select idUser2 from suivre where idUser= ?");
        $st->execute([$_SESSION['user']['id']]);
        while($row = $st->fetchAll()){
            $this->tabSuivi[] = $row['idUser2'];
        }
        return $this->tabSuivi;
    }

    
}