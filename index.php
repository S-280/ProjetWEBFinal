<<<<<<< HEAD
<?php
require_once ('php/function_database.php');
$database = dbConnect();
if (!$database) {
  header('HTTP/1.1 503 Service Unavailable');
  exit;
}
if (isset($_POST["connexion"])) {
  extract ($_POST);
  $connexion_inscription = "connexion";
  if(empty($pseudo)){
    erreurs_formulaire($connexion_inscription, "pseudo");
  }
  if(empty($mot_de_passe)){
    erreurs_formulaire($connexion_inscription, "mot_de_passe");
  }
  $mot_de_passe_base_de_donnees = dbRequestConnexionUser($database, $pseudo);
  foreach($mot_de_passe_base_de_donnees as $mot_passe){
     $mot_de_passe_user = $mot_passe[0];
   }
  $mot_de_passe = sha1($mot_de_passe);
  if ($mot_de_passe_user != $mot_de_passe) {
    erreurs_formulaire($connexion_inscription, "mot_de_passe");
  } else {
    header("Location: accueil.php");
  }
}
if (isset($_POST["inscription"])) {
  extract ($_POST);
  $connexion_inscription = "inscription";
  if(empty($nom)){
    erreurs_formulaire($connexion_inscription, "nom");
  }
  if(empty($prenom)){
    erreurs_formulaire($connexion_inscription, "prenom");
  }
  if(empty($pseudo)){
    erreurs_formulaire($connexion_inscription, "pseudo");
  }
  if(empty($mail) || preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)){
    erreurs_formulaire($connexion_inscription, "mail");
  }
  if(empty($mot_de_passe)){
    erreurs_formulaire($connexion_inscription, "mot_de_passe");
  }
  if(empty($confirmation_mot_de_passe)){
    erreurs_formulaire($connexion_inscription, "confirmation_mot_de_passe");
  }
  if ($mot_de_passe == $confirmation_mot_de_passe) {
    dbAddUser($database, $nom, $prenom, $pseudo, $mail, $mot_de_passe);
    header("Location: accueil.php");
  }

}
?>

<!DOCTYPE html>
<html lang="fr">
<?php
require_once ('include/head.php');
?>

  <body>
	<div id="bandeau">
		<?php include 'header.php';?>
	</div>
	<div id="menu">
		<?php include 'menu.php';?>
	</div>

  <div class="connexion">
    <h2>Se connecter</h2>
    <form action="index.php" class="formulaire_connexion" method="post">
      <div class="form-group">
        <label for="pseudo">Votre pseudo</label>
        <input type="text" class="form-control" name="pseudo" placeholder="Entrez votre pseudo">
      </div>
      <div class="form-group">
        <label for="mot_de_passe">Votre mot de passe</label>
        <input type="password" class="form-control" name="mot_de_passe" placeholder="• • • • • • • •">
      </div>
      <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
    </form>
  </div>

  <div class="inscription">
    <h2>S'inscrire</h2>
    <form action="index.php" class="formulaire_inscription" method="post">
      <div class="row">
        <div class="form-group col">
          <label for="nom">Votre nom</label>
          <input type="text" class="form-control" name="nom" placeholder="Entrez votre nom">
        </div>
        <div class="form-group col">
          <label for="prenom">Votre prénom</label>
          <input type="text" class="form-control" name="prenom" placeholder="Entrez votre prenom">
        </div>
      </div>
      <div class="form-group">
        <label for="pseudo">Votre pseudo</label>
        <input type="text" class="form-control" name="pseudo" placeholder="Entrez votre pseudo">
      </div>
      <div class="form-group">
        <label for="mail">Votre mail</label>
        <input type="email" class="form-control" name="mail" placeholder="Entrez votre mail">
      </div>
      <div class="row">
        <div class="form-group col">
          <label for="mot_de_passe">Votre mot de passe</label>
          <input type="password" class="form-control" name="mot_de_passe" placeholder="• • • • • • • •">
        </div>
        <div class="form-group col">
          <label for="confirmation_mot_de_passe">Confirmer votre mot de passe</label>
          <input type="password" class="form-control" name="confirmation_mot_de_passe" placeholder="• • • • • • • •">
        </div>
      </div>
      <button type="submit" name="inscription" class="btn btn-primary">S'inscrire</button>
    </form>
  </div>

</body>
</html>

<?php

function erreurs_formulaire($connexion_inscription, $input)
{
  if ($connexion_inscription == "connexion") {
    echo "<style>form.formulaire_connexion input[name=".$input."] { border: 1px solid red; } form.formulaire_connexion label[for=".$input."] { color: red;}</style>";
  } elseif ($connexion_inscription == "inscription") {
    echo "<style>form.formulaire_inscription input[name=".$input."] { border: 1px solid red; } form.formulaire_inscription label[for=".$input."] { color: red;}</style>";
  }
}



?>
