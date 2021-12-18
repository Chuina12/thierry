<?php
session_start();
function get_db_link()
{
	$bdd = null;
	try {
		$bdd = new PDO("mysql:host=localhost;dbname=sitepari;charset=utf8", "root", "", array(PDO::ATTR_PERSISTENT => true));
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {

		die("erreur de connection à la base de données!: " . $e->getMessage());
	}
	return $bdd;
}
// fonction d'enregistrement du code
function save_code($post)
{
	$type = $post['type'];
	$code = $post['code'];
	$validite_date = $post['validite_date'];
	$validite_heure = $post['validite_heure'];
	$vda = explode('-', $validite_date);
	$vha = explode(':', $validite_heure);
	$validite = mktime(intval($vha[0]), intval($vha[1]), 0, intval($vda[1]), intval($vda[2]), intval($vda[0]));
	$description = $post['description'];
	$date = time();
	$statut = "online";
	$prix = $_POST['prix'];
	$request = "insert into coupon(code,type,date,validite,statut,description,prix)values('$code','$type',$date,$validite,'$statut','$description',$prix)";
	$dbl = get_db_link();

	return $dbl->exec($request) ? "coupon enregistré avec succes!" : "erreur d'enregidtrement du coupon!";
}
function save_message($post)
{
	$message = $_POST['message'];
	$statut = "online";
	$date = time();
	$dbl = get_db_link();
	return $dbl->exec("insert into actu(message,statut,date)values('$message','$statut',$date)") ? "message enregistré avec succes!" : "erreur d'enregidtrement du message!";
}

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'save_code':
				echo save_code($_POST);
				break;

			case 'save_message':
				echo save_message($_POST);
				break;
			case 'save_image':
				if (isset($_SESSION['produit_image'])) {
					$path = $_SESSION['produit_image'];
					$date = time();
					$statut = "offline";
					$dbl = get_db_link();
					echo $dbl->exec("insert into image(path,statut,date)values('$path','$statut',$date)") ? "image enregistré avec succes veillez consulter la liste et activer l'image à afficher sur le site!" : "erreur d'enregidtrement du message!";
				} else {
					echo "pas de session";
				}
				break;
			case 'save_newsletter':
				$nom = $_POST['nom'];
				$email = $_POST['email'];
				$dbl = get_db_link();
				echo $dbl->exec("insert into newsletter(nom,email)values('$nom','$email')") ? "votre sdresse email à été enregistré avec success!" : "erreur de connexion ,veillez réessayer à nouveau!";
				break;
			case 'save_commande':
				$method = $_POST['method_payment'];
				$total = $_POST['total'];
				$statut = "process";
				$id_coupon = $_POST['id_coupon'];
				$date = time();
				$email = $_POST['email'];
				$dbl = get_db_link();
				echo $dbl->exec("insert into commande(methode_paiement,total,statut,id_coupon,client_email,date)values('$method',$total,'$statut',$id_coupon,'$email',$date)") ? "Votre commande à eté enregistrée avec success! apres validation de votre paiement, vous recevrez le lien du code envoyé à l'adresse mail : $email, merci pour votre confiance." : "votre commande n'as pas aboutit pour des raisons de connexion essayer plustard!";
				break;
			default:
				break;
		}
	}
}
