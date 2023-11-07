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

    public function compact(): string {
        return "<h1>{$this->touite->__get("titre")}</h1>
                <h2>{$this->touite->__get("auteur")}</h2>";
    }

    /**
     * @throws InvalidPropertyNameException
     */
    public function long(): string {
        return "<h1>{$this->touite->__get("titre")}</h1>
                <h2>{$this->touite->__get("auteur")}</h2>
                <p>{$this->touite->__get("date")->format("F j, Y, g:i a")}</p>
                <p>{$this->touite->__get("texte")}</p>
                <p>{$this->touite->__get("score")}</p>";
    }

}