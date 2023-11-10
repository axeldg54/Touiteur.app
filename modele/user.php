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
        <div class="profile-summary container">
            <div class="welcome-message">
                <h1>Touiteur.app</h1>
                <h1>~ Profil ~</h1>
                <div class="user-info">
                  <p><span class="label">Nom :</span> {$_SESSION['user']['nom']}</p>
                  <p><span class="label">Prénom :</span> {$_SESSION['user']['prenom']}</p>
                  <p><span class="label">ID :</span> {$_SESSION['user']['id']}</p>
</div>
            </div>
            <div class="profile-actions">
               <a href="?action=accueil" class="userButton largeButton">Accueil</a>
                <a href="?action=sign-in" class="userButton largeButton">Connexion</a>
                <a href="?action=register" class="userButton largeButton">Inscription</a>
                <a href="?action=deconnexion" class="userButton largeButton">Se déconnecter</a>

            </div>
            <p class="msgRefus" style="color:red;">$refus</p>
            <p class="msgAccept" style="color:limegreen;">$accept</p>
        </div>

        <div class="container">
            <h1>Suivre un utilisateur</h1>
            <div class="content">
                <p>Entrez l'email de la personne que vous voulez suivre</p>
                <form id="form-follow" method="POST" action="index.php?action=user-sub" class="form-container">
                    <input type="email" id="email" name="email" value="john.doe@example.com" class="form-input" required>
                    <input type="submit" value="Suivre" class="userButton">
                </form>
            </div>
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
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f4f4f8;
  color: #333;
  line-height: 1.6;
  margin: 0;
  padding: 20px;
}

.wrapper {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
}

.container {
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 20px;
  flex: 0 1 300px;
  padding: 15px;

}

.user-info, .actions, .form-container {
  margin-bottom: 15px;
}

h1 {
  color: #5D3FD3;
  margin-bottom: 10px;
  text-align: center;
}

.user-info {
  background: #f9f9f9;
  border-radius: 8px;
  padding: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  max-width: 300px;
  width: 100%;
  margin: auto;
  text-align: left;
}

.user-info p {
  font-size: 16px;
  color: #333;
  margin: 5px 0;
  line-height: 1.4; 
}

.user-info p span.label {
  font-weight: bold;
  margin-right: 10px;
}

p {
    text-align: center;
}

.profile-summary {
  order: -1;
  flex: 1 100%; 
  display: flex;
  flex-direction: column; 
  align-items: center;
  padding: 20px;
  margin-bottom: 30px;
  background-color: #e8eaf6; 
}

.welcome-message {
  text-align: center;
  margin-bottom: 20px;
}

.profile-actions {
  display: flex;
  justify-content: center;
  gap: 10px; 
  flex-wrap: wrap;
  margin-top: 30px; 
}

.userButton {
  background-color: #5D3FD3;
  color: white;
  padding: 15px 30px; 
  font-size: 16px; 
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  box-sizing: border-box;
}

.userButton:hover {
  background-color: #4a31c3;
}

.largeButton {
  min-width: 150px;
  padding: 15px 25px; 
  font-size: 18px; 
}

.form-input {
  width: calc(100% - 22px);
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  display: block;
}

label {
  display: block;
  margin-bottom: 5px;
}


input[type="submit"] {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 4px;
  background: #4CAF50;
  color: white;
  cursor: pointer;
}

input[type="submit"]:hover {
  background: #45a049;
}


  @media (max-width: 992px) {
  .profile-summary {
    flex-direction: column;
  }

  .container {
    flex: 0 1 auto;
    width: 100%;
  }
}

.msgRefus {
  color: #e74c3c;
  padding: 10px;
  border-radius: 5px;
}

.msgAccept {
  color: #2ecc71;
  padding: 10px;
  border-radius: 5px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}


    </style>
FIN;