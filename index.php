<?php
declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\render\RendererTouite;

ConnectionFactory::setConfig('./conf/connexion.ini');

$touite = new Touite("hello world", "Axel", "Titre 1");
$touiteRender = new RendererTouite($touite);

echo $touiteRender->compact();
echo $touiteRender->long();