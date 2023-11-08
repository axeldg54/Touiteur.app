<?php

namespace iutnc\deefy\list;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\image\Image;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\tri\Tri;

class ListTouiteSuivi{

    protected array $tabSuivi;

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

    public function trierTouites() : void{
        $this->tabSuivi = Tri::tri($this->tabSuivi);
    }

    public function recupererListeUtilisateurSuivi() : array{
        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare("select idUser2 from suivre where idUser= ?");
        $st->execute([$_SESSION['user']['id']]);
        while($row = $st->fetchAll()){
            $this->tabSuivi[] = $row['idUser2'];
        }
        return $this->tabSuivi;
    }

    public function recupererListeTouiteSuivi() : ListTouiteSuivi{
        $lt = new ListTouiteSuivi();
        $this->tabSuivi = $this->recupererListeUtilisateurSuivi();
        $db = ConnectionFactory::makeConnection();
        $st = $db->prepare("select touite.idTouite, texte,touite.idImage from touite 
                            inner join image on touite.idImage=image.idImage 
                            inner join publier on touite.idTouite=publier.idTouite where publier.idUser = ?");
        foreach ($this->tabSuivi as $value){
            $st->execute([$value]);
            while($row = $st->fetchAll()){
                $lt->addTouite($row);
            }
        }
        return $lt;
    }

}