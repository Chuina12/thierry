<?php
session_start();
if (!isset($_SESSION['admin_check_up']) or $_SESSION['admin_check_up'] != "SUCCESS_AUTHENTICATE")
	header('location:admin.php');
function get_db_link()
{
	$bdd = null;
	try {
		$bdd = new PDO("mysql:host=localhost;dbname=sitepari;charset=utf8", "root", "", array(PDO::ATTR_PERSISTENT => true));
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {

		die("erreur de connection à la base de données!");
	}
	return $bdd;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<style rel="stylesheet">
		table {
			width: 100%;
			border: 1px solid #bbb;
			padding: 20px;
		}

		table tr {
			border-top: 1px solid #bbb;
		}
	</style>
	<title>Espace d'administration</title>
	<meta charset="utf-8">
	<meta name="Keywords" content="coupon 1XBET">
	<meta name="Author" content="coupon 1XBET">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<link rel="shortcut icon" href="img\logoicon.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
	<article>
		<div class=" m-3 p-3">
			<h2 class='text-center text-success'>Bienvenu dans l'espace administrateur!</h2>
			<div class="row mt-3 pt-3">
				<div class="col-md-3 border rounded">
					<h3 class='text-center mt-2 text-info bg-light'>Statistiques</h3>
					<div class="row">
						<?php
						$dbl = get_db_link();
						$res = $dbl->query("select count(*) AS nb from coupon where statut='online'order by date desc");
						$cursor = $res->fetch(PDO::FETCH_ASSOC);
						$nbactif = $cursor['nb'];
						$stamp = time();
						$res = $dbl->query("select count(*) AS nb from coupon where validite<$stamp order by date desc");
						$cursor = $res->fetch(PDO::FETCH_ASSOC);
						$nbexp = $cursor['nb'];
						$res = $dbl->query("select count(*) AS nb from actu where 1 order by date desc");
						$cursor = $res->fetch(PDO::FETCH_ASSOC);
						$nbmess = $cursor['nb'];
						$res = $dbl->query("select count(*) AS nb from image where 1 order by date desc");
						$cursor = $res->fetch(PDO::FETCH_ASSOC);
						$nbimg = $cursor['nb'];
						$res = $dbl->query("select count(*) AS nb from commande where 1 order by date desc");
						$cursor = $res->fetch(PDO::FETCH_ASSOC);
						$nbcmd = $cursor['nb'];
						?>
						<div class="col-12 bg-light">
							<h4>Coupons Actifs : <?php echo $nbactif; ?></h4><br>
							<p><a href="?action=accueil" class="badge badge-md badge-dark p-2">Ajouter</a><a href="?action=coupon" class="badge badge-md badge-danger p-2 ml-3">detail</a></p>
						</div>
						<div class="col-12 bg-light border-top">
							<h4>Coupons expirés: <?php echo $nbexp; ?></h4><br>
							<p><a href="?action=coupon&query_action=1" class="badge badge-md badge-primary p-2 ml-3">detail</a></p>
						</div>
						<div class="col-12 bg-light border-top">
							<h4>Messages actu : <?php echo $nbmess; ?></h4>
							<p><a href="?action=message" class="badge badge-md badge-success p-2 ml-3">detail</a></p>
						</div>
						<div class="col-12 bg-light border-top">
							<h4>Images accueil: <?php echo $nbimg; ?></h4>
							<p><a href="?action=image" class="badge badge-md badge-danger p-2 ml-3">detail</a></p>
						</div>
						<div class="col-12 bg-light border-top">
							<h4>Commandes: <?php echo $nbcmd; ?></h4>
							<p><a href="?action=commande" class="badge badge-md badge-warning p-2 ml-3">detail</a></p>
						</div>
						<div class="col-12 text-center">
							<a href="" class="btn btn-md btn-primary m-3">Actualiser?</a>
							<a href="?action=deconnexion" class="btn btn-md btn-danger m-3">Deconnexion?</a>
						</div>
					</div>
				</div>

				<div class="col-md-9 ">
					<?php ob_start(); ?>
					<div class="row m-3 pt-3 border rounded">
						<div class="col-12 p-3">
							<form action="traitement.php" method="post">
								<div class="form-row">
									<input type="hidden" name="type" value="1xbet" />
									<input type="hidden" name="action" value="save_code" />
									<h3 class="text-center text-secondary"> Ajouter un Coupon 1xBet</h3>
									<div class="col-12">
										<label for="code">Code
										</label><br>
										<input type="text" id="code" name="code" class="form-control" required />
										<label>Description du code</label><br>
										<input type="text" class="form-control" name="description" required />
										<label>Prix du code</label><br>
										<input type="number" class="form-control" name="prix" required />
									</div>
									<div class="col-6">
										<label for="vlt">Validité
										</label><br>
										<input type="date" id="vlt" name="validite_date" required class="form-control" />
									</div>
									<div class="col-6">
										<label for="vlt21">Heure
										</label><br>
										<input type="time" id="vlt21" name="validite_heure" required class="form-control" />
									</div>
									<div class="col-12"><br>
										<input type="submit" class="btn btn-md btn-danger" value="Enregistrer" />
									</div>
								</div>
							</form>
						</div>

						<div class="col-12 p-3 border-top">
							<form action="traitement.php" method="post">
								<div class="form-row">
									<input type="hidden" name="type" value="melbet" />
									<input type="hidden" name="action" value="save_code" />
									<h3 class="text-center text-secondary"> Ajouter un Coupon MelBet</h3>
									<div class="col-12">
										<label for="code2">Code
										</label><br>
										<input type="text" id="code2" name="code" required class="form-control" />
										<label>Description du code</label><br>
										<input type="text" class="form-control" name="description" required />
										<label>Prix du code</label><br>
										<input type="number" class="form-control" name="prix" required />
									</div>
									<div class="col-6">
										<label for="vlt2">Validité
										</label><br>
										<input type="date" id="vlt2" name="validite_date" required class="form-control" />
									</div>
									<div class="col-6">
										<label for="vlt22">Heure
										</label><br>
										<input type="time" id="vlt22" name="validite_heure" required class="form-control" />
									</div>
									<div class="col-12"><br>
										<input type="submit" class="btn btn-md btn-info" value="Enregistrer" />
									</div>
								</div>
							</form>
						</div>
						<div class="col-12 p-3 border-top">
							<form action="traitement.php" method="post">
								<div class="form-row">
									<input type="hidden" name="type" value="melbet" />
									<input type="hidden" name="action" value="save_message" />
									<h3 class="text-center text-secondary"> Ajouter un message d'actualité</h3>
									<div class="col-12">
										<label for="msg">Texte defilant
										</label><br>
										<input type="text" id="msg" name="message" required class="form-control" /><br>
										<input type="submit" class="btn btn-md btn-primary" value="Enregistrer" />
									</div>
								</div>
							</form>

						</div>
						<div class="col-12 p-3 border-top">
							<form action="traitement.php" method="post">
								<div class="form-row">
									<input type="hidden" name="action" value="save_image" />
									<h3 class="text-center text-secondary"> Ajouter une image</h3>
									<div class="col-12">
										<label for="msg">Selectionnez l'image
										</label><br>
										<div id="pick_image"></div>
									</div>
								</div>
								<br> <input type="submit" class="btn btn-md btn-dark" value="Enregistrer" />
							</form>
							<?php
							include_once("vendors/core.php");
							pick_image();
							?>

						</div>
					</div>
					<?php $accueil = ob_get_clean();
					//===============liste des coupons actifs et statuts
					ob_start();
					?>
					<div class="row">
						<div class="col-12 border p-3">
							<h3 class="text-center text-secondary"> Liste des coupons Publiés!</h3>
							<p class="text-center">Voici la liste de tous les coupons publiés dans le site et par date de publications</p>
							<table>
								<thead>
									<th>N°</th>
									<th>Code coupon</th>
									<th>Type</th>
									<th>Publier le</th>
									<th>Expire le</th>
									<th>Achat</th>
									<th>statut</th>
									<th>Action</th>
								</thead>
								<tbody>
									<?php
									$dbl = get_db_link();
									$stamp = time();
									$res = isset($_GET['query_action']) ? $dbl->query("select * from coupon where validite<$stamp order by date desc") : $dbl->query("select * from coupon where 1 order by date desc");
									$cursor = $res->fetchAll();
									if (count($cursor)) {
										$i = 0;
										while ($i < count($cursor)) {
											$id = $cursor[$i]['id'];
											$code = $cursor[$i]['code'];
											$date = date("d/m/Y à H:m:s", $cursor[$i]['date']);
											$exp = date("d/m/Y à H:m:s", $cursor[$i]['validite']);
											$res2 = $dbl->query("select count(*) AS nb from commande where id=$id AND statut='payer'");
											$cursor2 = $res2->fetch(PDO::FETCH_ASSOC);
											$nb = $cursor2['nb'];
											$statut = $cursor[$i]['statut'];
											$type = $cursor[$i]['type'];
											$k = $i + 1;
											echo "
												 <tr>
												 <td>$k</td>
												 <td>$code</td>
												 <td>$type</td>
												 <td>$date</td>
												 <td>$exp</td>
												 <td>$nb fois</td>
												 <td>$statut</td>
												 <td><a href='administrateur.php?action=delete&id=$id&service=coupon'class='btn btn-sm btn-danger'>supprimer</a></td>
												 </tr>
											";
											$i++;
										}
									} else {
										echo "<div class='border rounded text-center p-3 m-auto bg-light'><h4>Aucun coupon en ligne pour le moment</h4><br>
											<a href='administrateur.php'class='btn btn-md btn-primary'>Publier un coupon</a></div>";
									}
									?>
								</tbody>

							</table>
						</div>
					</div>
					<?php
					$coupon_list = ob_get_clean();
					ob_start();
					// details messages actu
					?>
					<div class="row">
						<div class="col-12">
							<h3 class="text-center text-secondary"> Liste des messages d'actualité!</h3>
							<p>Voici la liste de tous les message d'actualité publiés dans le site et par date de publications</p>
							<table>
								<thead>
									<th>N°</th>
									<th>Messages</th>
									<th>Publier le</th>
									<th>statut</th>
									<th>Action</th>
								</thead>
								<tbody>
									<?php
									$res = $dbl->query("select * from actu where 1");
									$cursor = $res->fetchAll();
									if (count($cursor)) {
										$i = 0;
										while ($i < count($cursor)) {
											$id = $cursor[$i]['id'];
											$date = date("d/m/Y à H:m:s", $cursor[$i]['date']);
											$message = $cursor[$i]['message'];
											$statut = $cursor[$i]['statut'];
											$k = $i + 1;
											echo "
											   <tr>
											 <td>$k</td>  
											 <td>$message</td> 
											 <td>$date</td> 
											 <td>$statut</td> 
											 <td><a href='administrateur.php?action=delete&id=$id&service=message'class='btn btn-sm btn-danger'>supprimer</a></td> 
											   </tr>
											";
											$i++;
										}
									} else {
										echo "<div class='border rounded text-center p-3 m-auto bg-light'><h4>Aucun coupon en ligne pour le moment</h4><br>
											<a href='administrateur.php'class='btn btn-md btn-primary'>Publier une actualité</a></div>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<?php $actu = ob_get_clean();
					ob_start(); ?>
					<div class="row">
						<div class="col-12">
							<h3 class="text-center text-secondary"> Liste des images d'accueil</h3>
							<p>Voici la liste de tous les images charger dans le site.</p>
							<table>
								<thead>
									<th>N°</th>
									<th>Images</th>
									<th>Publier le</th>
									<th>statut</th>
									<th>Action</th>
								</thead>
								<tbody>
									<?php
									$res = $dbl->query("select * from image where 1");
									$cursor = $res->fetchAll();
									if (count($cursor)) {
										$i = 0;
										while ($i < count($cursor)) {
											$id = $cursor[$i]['id'];
											$date = date("d/m/Y à H:m:s", $cursor[$i]['date']);
											$path = "vendors/upload/" . $cursor[$i]['path'];
											$statut = $cursor[$i]['statut'];
											$k = $i + 1;
											echo "
											   <tr>
											 <td>$k</td>  
											 <td><img src='$path'style='width:120px;height:auto;'/></td> 
											 <td>$date</td> 
											 <td>$statut</td> 
											 <td><a href='administrateur.php?action=enabled&id=$id&service=image'class='btn btn-sm btn-dark'>activer?</a></td> 
											   </tr>
											";
											$i++;
										}
									} else {
										echo "<div class='border rounded text-center p-3 m-auto bg-light'><h4>Aucune image en ligne pour le moment</h4><br>
											<a href='administrateur.php'class='btn btn-md btn-primary'>charger une image</a></div>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<?php
					$image = ob_get_clean();
					ob_start();
					?>
					<div class="row">
						<div class="col-12">
							<h3 class="text-center text-secondary"> Liste des commandes</h3>
							<p>Voici la liste de tous les commandes effectuées par les clients du site.</p>
							<table>
								<thead>
									<th>N°</th>
									<th>code coupon</th>
									<th>date</th>
									<th>Clients</th>
									<th>paiement</th>
									<th>Total</th>
									<th>statut</th>
								</thead>
								<tbody>
									<?php
									$dbl = get_db_link();
									$res = $dbl->query("select * from commande where 1 order by date desc");
									$cursor = $res->fetchAll();
									if (count($cursor)) {
										$i = 0;
										while ($i < count($cursor)) {
											$id = $cursor[$i]['id_coupon'];
											$date = date("d/m/Y H:m", $cursor[$i]['date']);
											$client = $cursor[$i]['client_email'];
											$statut = $cursor[$i]['statut'];
											$method = $cursor[$i]['methode_paiement'];
											$total = $cursor[$i]['total'];
											$res2 = $dbl->query("select code from coupon where id=$id");
											$cursor2 = $res2->fetch(PDO::FETCH_ASSOC);
											$code = $cursor2['code'];
											$k = $i + 1;
											echo "
											   <tr>
											 <td>$k</td>  
											 <td>$code</td> 
											 <td>$date</td> 
											 <td>$client</td> 
											 <td>$method</td> 
											 <td>$total FCFA</td> 
											 <td>$statut </td> 
											   </tr>
											";
											$i++;
										}
									} else {
										echo "<div class='border rounded text-center p-3 m-auto bg-light'><h4>Aucune commande enregistréé pour le moment</h4><br>
											<a href='administrateur.php'class='btn btn-md btn-primary'>Publier un code!</a></div>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<?php $commande = ob_get_clean();
					if (isset($_GET['action'])) {
						switch ($_GET['action']) {
							case 'accueil':
								echo $accueil;
								break;
							case 'coupon':
								echo $coupon_list;
								break;
							case 'message':
								echo $actu;
								break;
							case 'image':
								echo $image;
								break;
							case 'commande':
								echo $commande;
								break;
							case 'delete':
								$id = $_GET['id'];
								$service = $_GET['service'];
								if ($service == "coupon") {
									$dbl = get_db_link();
									$res = $dbl->exec("delete from coupon where id=$id");
									if ($res) {
										echo "code supprimé avec succes!";
									}
								}
								break;
							case 'enabled':
								$id = $_GET['id'];
								$service = $_GET['service'];
								if ($service == "image") {
									$dbl = get_db_link();
									$dbl->exec("update image set statut='offline'where 1");
									$res = $dbl->exec("update image set statut='online'where id=$id");
									if ($res) {
										echo "image activée avec succes!";
									}
								}
								break;
							case 'deconnexion':
								$_SESSION['admin_chech_up'] = null;
								session_destroy();
								header('location:index.php');
								break;
							default:
								echo $accueil;
								break;
						}
					} else {
						echo $accueil;
					}
					?>
				</div>
			</div>
		</div>
	</article>


	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>