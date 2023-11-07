<?php

declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use \iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\render\RendererTouite;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\image\Image;

ConnectionFactory::setConfig('./conf/connexion.ini');
$image = new Image("rectangle", "/img/rectangle.png");
$tag = new Tag("tag 1", "tag 1");
$touite = new Touite("hello world", "Axel", "Titre 1", $image);
$touite->addTag($tag);
$touiteRender = new RendererTouite($touite);

echo $touiteRender->render(2);
echo $touiteRender->render(1);

$listeTouites = new ListTouite();
$listeTouites->addTouite(new Touite("texte1","auteur1", "titre 1", new Image("description1", "chemin1")),);
$listeTouites->addTouite(new Touite("texte2","auteur2", "titre 2", new Image("description2", "chemin2")));

foreach($listeTouites->tabTouites as $key => $val){
    (new RendererTouite($val))->render(Renderer::COMPACT);
}

echo $touiteRender->render(2);
echo $touiteRender->render(1);