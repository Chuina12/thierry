<div class="divimgcode" style=" width: 20%;">
	<img class="imgheadercode" src="img/logo.jpg" style=" width: 80%; border:2px solid rgb(2,6,69); border-radius: 100%; margin-top : 8%; margin-left: 2%;" />
</div>
<div class="div1XB" style=" width: 80%;">
	<div class="divimg1XB">
		<?php
		function get_db()
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

		$db = get_db();
		$res = $db->query("select * from image where statut='online'order by date desc");
		$cursor = $res->fetch(PDO::FETCH_ASSOC);
		$src = "vendors/upload/" . $cursor['path'];
		?>
		<img id="inter" src="<?php echo $src ?>" style="margin:20px;" />
		<i><a href="admin.php">connexion<img src="img/login.png" width="50px" ; height="50px" ;></a></i>
	</div>
	<a href=""><img " class=" imglogin" /></a>
	<div class="btnheader">
		<div class="btnheader1">
			<h3>C'est quoi un coupon ?</h3>
		</div>
		<div class="btnheader1">
			<h3>Coupon 1XBET</a></h3>
		</div>
		<div class="btnheader1">
			<h3>Coupon Melbet</h3>
		</div>
	</div>
</div>