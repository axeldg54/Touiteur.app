<?php
declare(strict_types = 1);
namespace iutnc\deefy\render;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\touite\Touite;

class RendererTouite {

    private Touite $touite;

    private string $valeurBouton;

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
            $t = $t . $tag->__get("libelle") . ' ';
        }
        return "<div class='post__body'>
        <div class='post__header'>
            <div class='post__headerText'>
                <h3>
                    " . $this->touite->__get("auteur") . "
                    <span class='post__headerSpecial'>
                    <span class='material-icons post__badge'> verified </span>@user</span>
                </h3>
            </div>
            <div class='post__headerDescription'>
                <p>". $this->touite->__get("texte") ."</p>
            </div>
        </div>
        <img
            src='".$this->touite->__get("image")->__get("chemin")."'
            alt='' class='touite-image'/>
        <div class='touite-interaction'>
            <div class='touite-likes-tags'>
                <p class='touite-likes'>Likes: ". $this->touite->__get("score") ."</p>
                <p class='touite-tags'>Tags: ". $t ."</p>
            </div>
            <p class='touite-date'>". $this->touite->__get("date")->format("F j, Y, g:i a") ."</p>
        </div>
        <div class='follow'>
            <button type='button'>Suivre</button>
            <button type='button'>Suivre Tags</button>
        </div>
    </div>
<style>
      .touite-interaction {
    display: block;
    padding: 10px;
    background: #f8f8f8;
    border-top: 1px solid #e1e8ed; 
    border-bottom: 1px solid #e1e8ed;
}

.touite-likes-tags {
    display: flex-start;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.touite-likes {
    font-size: 16px;
    color: #657786;
    font-weight: bold;
}

.touite-tags {
    font-size: 14px; 
    color: #9370DB; 
    font-weight: bold;
}

.touite-date {
    display: block;
    text-align: right;
    font-size: 12px;
    color: #8899a6;
    margin-top: -5px;
}

.follow {
    text-align: center;
    padding: 10px 0;
    background: #f4f4f4;
    border-top: 1px solid #e1e8ed;
}

.follow button {
    padding: 8px 16px; 
    margin: 0 5px;
    background-color: #483D8B;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: background-color 0.3s, box-shadow 0.3s;

.follow button:hover {
    background-color: #D8BFD8;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}


.touite-interaction .follow {
    text-align: right;
    padding: 0;
    background: none;
    border-top: none;
}

.touite-interaction .follow button {
    margin: 0;
    display: inline-block;
}

    </style>
    ";
    }
}