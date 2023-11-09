<?php
$suivi = \iutnc\deefy\user\User::getAbonnement();
$abonne = \iutnc\deefy\user\User::getAbonne();
$tag = \iutnc\deefy\user\User::getTag();

$refus = \iutnc\deefy\dispatch\Dispatcher::$refus;
$accept = \iutnc\deefy\dispatch\Dispatcher::$accept;

echo <<< FIN
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur Touiteur.app</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <div class="wrapper">

        <div class="container">
                <h1>Bienvenue sur Touiteur.app</h1>
                <div class="user-info">
                    <p>Nom : {$_SESSION['user']['nom']}</p>
                    <p>Prénom : {$_SESSION['user']['prenom']}</p>
                    <p>ID : {$_SESSION['user']['id']}</p>
                </div>
                <div class="actions">
                    <a href="?action=accueil" class="userButton">Accueil</a>
                    <a href="?action=sign-in" class="userButton">Connexion</a>
                    <a href="?action=register" class="userButton">Inscription</a>
                    <a href="?action=deconnexion" class="userButton">Se déconnecter</a>
                </div>
                <p class="msgRefus" style="color:red;">$refus</p>
                <p class="msgRefus" style="color:limegreen;">$accept</p>
        </div>
    

        <div class="container">
            <h1>Suivre un utilisateur</h1>
            <form id="form" method="POST" action="index.php?action=user-sub">
                <p>Entrez l'email de la personne que vous voulez suivre</p><br><br><br>
                <input type="email" id="email" name="email" value="john.doe@example.com" class="form-input" required>
                <input type="submit" value="Suivre" class="userButton">
            </form>
        </div>


        <div class="container">
            <h1>Se desabonner</h1>
            <form id="form" method="POST" action="index.php?action=user-unsub">
                <p>Entrez l'email de la personne dont vous souhaitez vous désabonner</p><br><br>
                <input type="email" id="email2" name="email2" value="john.doe@example.com" class="form-input" required>
                <input type="submit" value="Desabonner" class="userButton">
            </form>
        </div>
        
        
        <div class="container">
            <h1>Vos abonnements</h1>
            $suivi
        </div>
    

        <div class="container">
            <h1>Vos abonnés</h1>
            $abonne
        </div>


        <div class="container">
            <h1>Ajouter un tag</h1>
            <form id="form" method="POST" action="index.php?action=user-addtag">
                <p>Entrez le tag que vous voulez suivre avec le '#' avant</p><br><br>
                <input type="text" id="tag" name="tag" value="Vacances" class="form-input" required>
                <input type="submit" value="Ajouter" class="userButton">
            </form>
        </div>


        <div class="container">
            <h1>Enlever un tag</h1>
            <form id="form" method="POST" action="index.php?action=user-suptag">
                <p>Entrez le tag que vous voulez enlever avec le '#' avant</p><br><br>
                <input type="text" id="tag2" name="tag2" value="Vacances" class="form-input" required>
                <input type="submit" value="Supprimer" class="userButton">
            </form>
        </div>
        
        <div class="container">
            <h1>Liste de vos tags</h1>
            $tag;
        </div>
    
</div>
</body>
</html>

<style>
  body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #8458B3, #E98181);
    color: #ffffff;
    margin: 0;
    padding: 10px;
  }

  .container {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height: 300px;
    text-align: center;
    margin: 10px;
    padding: 10px;
  }

  .container p {
    color: #353b48;
    font-size: 16px;
    margin: 10px;
  }

  h1 {
    color: #353b48;
    font-size: 24px;
  }

  .userButton {
    width: 200px;
    padding: 10px;
    margin: 10px;
    border: none;
    border-radius: 4px;
    background: #353b48;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    text-decoration: none;
  }

  .actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    padding: 10px;
  }
  
  .form-input {
    width: 400px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .container p {
    color:#222831;
  }
  
  .wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
  }
</style>
FIN;