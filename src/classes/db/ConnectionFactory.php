<?php
declare(strict_types=1);
namespace iutnc\deefy\db;
use \PDO;

/**
 * Gestion de la connexion à la base de donnée
 */
class ConnectionFactory {

    /**
     * Déclarations des attributs
     */
    private static $tconfig;
    private static $pdo;

    /**
     * Ajoute le fichier de configuration à la base de donnée
     */
    public static function setConfig($file) {
        static::$tconfig = parse_ini_file($file);
    }

    /**
     * Réalise la connection à la base de donnée grâce au fichier de config
     */
    public static function makeConnection() {
        if (!isset(static::$pdo)) {
            $driver = static::$tconfig['driver'];
            $host = static::$tconfig['host'];
            $database = static::$tconfig['database'];
            $username = static::$tconfig['username'];
            $password = static::$tconfig['password'];
            $dsn = "$driver:host=$host;dbname=$database";
            static::$pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false,
            ]);
            static::$pdo->prepare('SET NAMES \'UTF8\'')->execute();
        }
        return static::$pdo;
    }

}