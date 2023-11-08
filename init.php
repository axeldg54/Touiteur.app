<?php


declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;
use \iutnc\deefy\list\ListTouite;
use iutnc\deefy\touite\Touite;
use iutnc\deefy\render\RendererTouite;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\image\Image;
use iutnc\deefy\tag\Tag;
use iutnc\deefy\initialisation\Initialisation;

ConnectionFactory::setConfig('./conf/connexion.ini');


$lt = ((new Initialisation())->initialiser_Touites());
foreach($lt->__get("tabTouites") as $key => $val){
    echo (new RendererTouite($val))->render(Renderer::LONG);
    $html = "
    <div class='post__body'>
    <div class='post__header'>
        <div class='post__headerText'>
            <h3>
                User
                <span class='post__headerSpecial'
                ><span class='material-icons post__badge'> verified </span>@user</span
                >
            </h3>
        </div>
        <div class='post__headerDescription'>
            <p>". $val->__get("texte") ."</p>
        </div>
    </div>
    <img
        src='images/what.avif'
        alt=''/>
        <p>". $val->__get("date")->format("F j, Y, g:i a") ."</p>
    </div>";
    echo $html;
}

