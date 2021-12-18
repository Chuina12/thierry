<div class="paragrsect" style="margin-top: -5px;">
	<marquee behavior="alternate" scrollamount="4">
		<h1 style="margin-bottom: -3px;">Bienvenue sur 1xCouponCode !</h1>
	</marquee><b>Coupon Code du jour</b>. NB: Ne parier pas sur l'ensemble des matchs proposer dans le coupon. Télécharger et ajuster ou parier sur chaque événement proposez dans le coupon pour faire des bénéfices !<h2>
		<center>APERÇUS ET PRÉVISIONS DE FOOTBALL</center>
	</h2>
	<p class="carosselcoupon"></p>
</div>
<div class="table row">
	<table>
		<?php
		$db = get_db_link();
		$res = $db->query("select * from coupon where 1");
		if (isset($_GET['action'])) {
			if ($_GET['action'] == "get_1x") {
				$res = $db->query("select * from coupon where type='1xbet'");
			} else {
				$res = $db->query("select * from coupon where type='melbet'");
			}
		}
		$cursor = $res->fetchAll();

		if (count($cursor)) {
			$k = 0;
			$n = 0;
			$m = 0;
			for ($i = 0; $i < count($cursor); $i++) {
				$k = $m;
				$n = 0;
				while ($k < count($cursor) && $cursor[$k] != null) {

					$type = $cursor[$k]['type'];
					$description = $cursor[$k]['description'];
					$id = $cursor[$k]['id'];
					$prix = $cursor[$k]['prix'];
					echo "<td>
					<div style='min-height:130px;border-radius:4px;border:1px solid #bbb;background:linear-gradient(#222256,#243545);color:#fff;padding:20px;'>
					<h2 class='text-center text-bold'> $type ($prix F)</h2>
					<p>$description</p>
					<a href='commande.php?coupon=$id'style='text-decoration:none;border-radius:4px;background-color:#eee;padding:5px;'>Acheter?</a>
					</div>
					</td>";
					$k++;
					$n++;
					$m++;
					if ($n == 3) {
						$k--;
						break;
					}
				}
				echo "</tr>";
			}
		} else {
			echo "<div class='border rounded text-center p-3 m-auto bg-light'><h2>Aucun code bonnus publié pour le moment!</h2><br>
				</div>";
		}


		?>
	</table>
</div>
<p align="center" style="color:teal;">Veuillez noter s'il vous plait que les cotes sont seulement indicatives, en effet elles peuvent varier après le moment de l'envoi</p>
<div style="margin-left:1%;margin-right:1%;border:1px solid #ccc;padding:40px;margin-top:30px;">
	<h2>Recevez par mail dès l'aparution des nouveaux codes Bonus</h2>
	<form action="traitement.php" method="post">
		<input type="hidden" name="action" value="save_newsletter" />
		<table>
			<tr>
				<td><label>Votre Nom</label></td>
				<td><input type="text" name="nom" /></td>
			</tr>
			<tr>
				<td><label>Votre Eamil</label></td>
				<td><input type="email" name="email" /></td>
			</tr>
		</table><br>
		<input type="submit" value="enregistrer">
	</form>
</div>