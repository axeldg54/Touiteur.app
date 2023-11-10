<?php

namespace iutnc\deefy\tri;

use \iutnc\deefy\touite\Touite;
use \iutnc\deefy\list\ListTouite;

class Tri{

    
    public static function sort(Touite $a, Touite $b){
        if($a->__get("date") < $b->__get("date")){
            return 1;
        }   
        else if($a->__get("date") > $b->__get("date")){
            return -1;
        }
        return 0;
    }

    public static function tri(array $listeTouites) : array{
        usort($listeTouites, array(new Tri(), "sort"));
        return $listeTouites;
    }
}