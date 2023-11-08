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

    public function render(int $selector = 1): string {
        if ($selector == 1) {
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
                    User
                    <span class='post__headerSpecial'
                    ><span class='material-icons post__badge'> verified </span>@user</span
                    >
                </h3>
            </div>
            <div class='post__headerDescription'>
                <p>". $this->touite->__get("texte") ."</p>
            </div>
        </div>
        <img
            src='../images/what.avif'
            alt=''/>
            <p>". $this->touite->__get("date")->format("F j, Y, g:i a") ."</p>
        </div>";
    }


    private function long(): string {
        $t = "";
        foreach ($this->touite->getTags() as $tag) {
            $t = $t . $tag->__get("libelle");
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