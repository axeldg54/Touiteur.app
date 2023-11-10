<?php

namespace iutnc\deefy\image;

use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\InvalidPropertyNameException;

class Image
{
    private string $description;
    private string $chemin;

    public function __construct(string $d, string $c)
    {
        $this->description = $d;
        $this->chemin = $c;
    }

    public function __get(string $attr): mixed
    {
        if (!property_exists($this, $attr)) {
            throw new InvalidPropertyNameException("Attribut $attr n'existe pas");
        } else {
            return $this->$attr;
        }
    }

    public static function insertImage(): int
    {
        // connexion bd
        $pdo = ConnectionFactory::makeConnection();

        // récupération des informations de l'image
        if (isset($_FILES['file'])) {
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
        }

        // incrementation de l'id de l'image
        $query = "select max(idImage) as max from Image";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetch();
        $idImage = $row['max'] + 1;

        $name = './img/'.$idImage.$name;
        // htmlspecialchars($name) régler problème des apostrophes dans url image

        // ajout de l'image dans le dossier img
        move_uploaded_file($tmpName, $name);

        // insertion de l'image
        $query = "insert into image(idImage,chemin,description) values(?,?,?)";
        $st = $pdo->prepare($query);
        $st->execute([$idImage, $name, 'image']);

        return $idImage;
    }
}