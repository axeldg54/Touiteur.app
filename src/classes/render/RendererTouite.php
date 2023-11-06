<?php
declare(strict_types = 1);
namespace iutnc\deefy\render;
use iutnc\deefy\touite\Touite;

class RendererTouite {

    private Touite $touite;

    public function __construct(Touite $t) {
        $this->touite = $t;
    }

    public function compact(): string {
        return "<h1>{$this->touite->getTitre()}</h1>
                <h2>{$this->touite->getAuteur()}</h2>";
    }

    public function long(): string {
        return "<h1>{$this->touite->getTitre()}</h1>
                <h2>{$this->touite->getAuteur()}</h2>
                <p>{$this->touite->getDate()->format("F j, Y, g:i a")}</p>
                <p>{$this->touite->getTexte()}</p>
                <p>{$this->touite->getScore()}</p>";
    }

}