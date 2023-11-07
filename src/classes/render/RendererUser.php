<?php
declare(strict_types = 1);
namespace iutnc\deefy\render;

use iutnc\deefy\user\User;

class RendererUser{
    private User $user;

    public function __construct(User $u) {
        $this->user = $u;
    }

    public function long() : string{
        return "<h1> {$this->user->__get("pseudo")} <\h1> 
                <h2>{$this->user->__get("nom")}</h2>
                <h2>{$this->user->__get("prenom")}</h2>";
    }

    public function render(int $selector): string
    {
            return $this->long();

    }

}