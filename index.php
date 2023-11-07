<?php
declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\image\Image;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\render\RendererTouite;

ConnectionFactory::setConfig('./conf/connexion.ini');

$image = new Image("rectangle", "/img/rectangle.png");
$touite = new Touite("hello world", "Axel", "Titre 1", $image);
$touiteRender = new RendererTouite($touite);

echo $touiteRender->render(2);
echo $touiteRender->render(1);