<?php

namespace iutnc\deefy\action;

/**
 * Gère les différentes actions enclenchées par l'utilisateur de l'application
 */
abstract class Action {

    /**
     * Déclarations des attributs
     */
    protected ?string $http_method = null;
    protected ?string $hostname = null;
    protected ?string $script_name = null;

    /**
     * Constructeur de la classe action. Initialise l'URL
     */
    public function __construct(){
        $this->http_method = $_SERVER['REQUEST_METHOD'];
        $this->hostname = $_SERVER['HTTP_HOST'];
        $this->script_name = $_SERVER['SCRIPT_NAME'];
    }

    /**
     * Traite l'action enclenché par l'utilisateur 
     * @return string contenant le code html qui traite l'action
     */
    abstract public function execute() : string;

}