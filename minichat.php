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

// Récupération des 10 derniers messages
    $reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-Chat</title>
    </head>
    <body>
    
    <form action="minichat_post.php" method="post">
        <p>
        <label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo"/>
        </p>
        <p>
        <label for="message">Message : </label><input type="text" name="message" id="message"/>
        </p>
        <p>
        <input type="submit" value="Envoyer"/>
	    </p>
    </form>

     <!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars) -->

    <?php while ($donnees = $reponse->fetch()):?>
        
        <?= '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';?>
    <?php endwhile; ?>

    <?php $reponse->closeCursor();?>
        
    

    </body>
</html>