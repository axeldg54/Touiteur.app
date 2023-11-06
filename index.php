<?php
declare(strict_types=1);
session_start();

require_once 'vendor/autoload.php';

use iutnc\deefy\db\ConnectionFactory;
\iutnc\deefy\db\ConnectionFactory::setConfig('./conf/connexion.ini');

