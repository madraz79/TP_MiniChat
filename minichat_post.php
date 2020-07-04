<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
// $req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(?, ?)');
// $req->execute(array($_POST['pseudo'], $_POST['message']));

$reqInsert = $bdd->prepare("INSERT INTO minichat(`id`, `pseudo`, `message`) VALUES (NULL, :pseudo, :tmessage)");

$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

$reqInsert->execute(array(
    'pseudo' => $pseudo,
    'tmessage' => $message
));

// Redirection du visiteur vers la page du minichat
header('Location: minichat.php');
?>