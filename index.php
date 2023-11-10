<?php

declare(strict_types=1);
require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\dispatch\Dispatcher;

session_start();
ConnectionFactory::setConfig('./conf/connexion.ini');



(new Dispatcher())->run();
