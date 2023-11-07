<?php

namespace iutnc\deefy\action;
use iutnc\deefy\playlist\Playlist;

class AddTouiteAction extends Action {

    public function execute(): string {
        $htmlContent = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $htmlContent = '
            <form id="form" method="POST" action="index.php?action=add-touite">
                <label for="form"> titre : </label>
                <input type="text" id="titre" name="titre" value="Rap musique" required>
                <input type="submit" value="Ajouter">
                ';
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            Playlist::add($titre);
            $htmlContent = $htmlContent . 'Playlist' . $titre . ' a bien été ajoutée';
        }
        return $htmlContent;
    }
}
