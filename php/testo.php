<form method='POST'>
<label>numero</label><input type='number' name='numero'></br></br>
<label>nom</label><input type='password' name='password'></br>
<input type='submit' value='envoyer'>

</form>


<?php


		//Connexion à la base de données


try
{
$bdd = new PDO('mysql:host=localhost;dbname=inscription', 'root', '');
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
// Insertion du message à l'aide d'une requête préparée

$numero = $_POST['numero'];
$mdp = $_POST['password'];

$req = $bdd->prepare('INSERT INTO connexion (numero, mdp)
VALUES(?, ?)');
$req->execute(array($numero, $mdp));


$req=$bdd->prepare('select * from connexion');
$req->execute();

while($data=$req->fetch()){
	?>

	<h1><?php echo $data['mdp'];?><a href="supprimer.php?numContact=<?php echo $data['id'];?>">supprimer</a></h1>

<?php
 }




?>




