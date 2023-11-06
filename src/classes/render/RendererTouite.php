<?php
declare(strict_types = 1);
namespace iutnc\deefy\render;
use \DateTime;
use iutnc\deefy\touite\Touite;

class RendererTouite {

    private Touite $touite;

    public function __construct(Touite $t) {
        $this->touite = $t;
    }

    private function compact(): string {
        return "<h1>{$this->touite->getTitre()}</h1>";
    }

    private function long(): string {
        return "<h1>{$this->touite->getTitre()}</h1>
                <h2>{$this->touite->getDate()}</h2>
                <h2>{$this->touite->getAuteur()}</h2>
                <p>{$this->touite->getTexte()}</p>
                <p>{$this->touite->getScore()}</p>";
    }

}