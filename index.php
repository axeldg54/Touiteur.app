<?php
declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\image\Image;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\render\RendererTouite;

ConnectionFactory::setConfig('./conf/connexion.ini');

$image = new Image("rectangle", "/img/rectangle.png");
$tag = new Tag("tag 1", "tag 1");
$touite = new Touite("hello world", "Axel", "Titre 1", $image);
$touite->addTag($tag);
$touiteRender = new RendererTouite($touite);

echo $touiteRender->render(2);
echo $touiteRender->render(1);