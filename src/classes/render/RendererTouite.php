<?php
declare(strict_types = 1);
namespace iutnc\deefy\render;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\touite\Touite;

class RendererTouite {

    private Touite $touite;

    public function __construct(Touite $t) {
        $this->touite = $t;
    }   

    public function render(int $selector): string {
        if ($selector === 1) {
            return $this->compact();
        } else {
            return $this->long();
        }
    }

    private function compact(): string {
        return "<div class='post__body'>
        <div class='post__header'>
            <div class='post__headerText'>
                <h3>
                " . $this->touite->__get("auteur") . "
                    <span class='post__headerSpecial'
                    ><span class='material-icons post__badge'> verified </span>@user</span
                    >
                </h3>
            </div>
            <div class='post__headerDescription'>
                <p>". $this->touite->__get("texte") ."</p>
            </div>
        </div>
        </div>";
    }


    private function long(): string {
        $t = "";
        
        foreach ($this->touite->getTags() as $tag) {
            $t =  $tag->__get("libelle") . " , " .  $t;
        }    
        return "<div class='post__body'>
        <div class='post__header'>
            <div class='post__headerText'>
                <h3>
                    " . $this->touite->__get("auteur") . "
                    <span class='post__headerSpecial'
                    ><span class='material-icons post__badge'> verified </span>@user</span>
                </h3>
            </div>
            <div class='post__headerDescription'>
                <p>". $this->touite->__get("texte") ."</p>
            </div>
            <div>
                <button type='button'>Suivre</button>
                <button type='button'>Suivre Tags</button>
            </div>
        </div>
        <img
            src='".$this->touite->__get("image")->__get("chemin")."'
            alt=''/>
            <p>Likes: ". $this->touite->__get("score") ."</p>
            <p>Tags: ". $t ."</p>
            <p>". $this->touite->__get("date")->format("F j, Y, g:i a") ."</p>
        </div>";
    }

}