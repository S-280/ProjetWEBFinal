<?php

// Fonction pour se connecter à la base de données
function dbConnect()
{
  $serveur = "localhost"; // Host
  $port = '3306'; // Port
  $dbname = 'burgerquizz'; // Database Name
  $charset = 'utf8'; // Charset
  $myDsn = "mysql:host=$serveur;port=$port;dbname=$dbname;charset=$charset;";

  $myDbLogin = "BurgerQuizz"; // Database login
  $myDbPwd = "QIjISVyC"; // Database password

  try
  {
    $database = new PDO($myDsn, $myDbLogin, $myDbPwd);
  }
  catch (PDOException $exception)
  {
    echo 'Erreur de connexion: '.$exception->getMessage(); // Gestion des erreurs
    return false;
  }
  return $database;
}

// Fonction pour enregistrer un nouvel utilisateur
function dbAddUser($database, $nom, $prenom, $identifiant, $mail, $mot_de_passe)
{
  $mot_de_passe = sha1($mot_de_passe);
  try
  {
    $maReq_Add_User = 'INSERT INTO `user`(`identifiant`, `mot_de_passe`, `nom`, `prenom`, `mail`)';
    $maReq_Add_User .= 'VALUES (:identifiant, :mot_de_passe, :nom, :prenom, :mail)';
    $statement = $database->prepare($maReq_Add_User);
    $statement->execute(array(
      ':identifiant' => $identifiant,
      ':mot_de_passe' => $mot_de_passe,
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':mail' => $mail
    ));
    $result = $statement->fetchAll();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;
}

// Fonction pour retourner le mot de passe de la table user pour un identifiant
function dbRequestConnexionUser($database, $identifiant)
{
  try
  {
    $statement = $database->prepare("SELECT mot_de_passe FROM user WHERE identifiant=:identifiant");
    $statement->bindParam(':identifiant', $identifiant);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  catch (PDOException $exception)
  {
    error_log('Request error: '.$exception->getMessage());
    return false;
  }
  return $result;
}

?>
