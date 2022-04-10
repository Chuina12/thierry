<?php
$bdd = new PDO('mysql:host=localhost;dbname=inscription', 'root', '');
$req=$bdd->PREPARE('DELETE FROM connexion WHERE id=:num LIMIT 1');
$req->bindValue(':num', $_GET['numContact']);
$val = $req->execute();














?>