<ul class="nav" type="none" style="width: 100%; height: 100%;">

	<li class="nav1"><a href="?action=get_1x" style="color:#fff;"> Acheter un coupon 1XBET</a></li>
	<li class="nav1"><a href="?action=get_mel" style="color:#fff;"> Acheter un coupon MelBet</a></li>
	<hr size="3" width="80%" align="CENTER">
	<div class="actus">
		<h2 align="center">Nos actus</h2>
		<img src="img/apostgauch.png" width="10%" align="left" class="apostrophes" />
		<div class="infos">
			<figure>
				<?php
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

				$db = get_db_link();
				$res = $db->query("select * from actu where 1");
				$cursor = $res->fetchAll();
				$message = json_encode($cursor);
				echo "<p id='info'data-message='$message'> 
	
	</p>";
				?>

			</figure>
		</div>
		<img src="img/apostdroit.png" width="10%" align="right" class="apostrophes" />
	</div>

</ul>

<script type="text/javascript">
	var txt = JSON.parse(document.getElementById('info').dataset.message);

	var i = 0;
	var infos = [];
	var infos_l = [];
	while (txt[i] != null) {
		infos_l[i] = txt[i].id;
		infos[i] = txt[i].message;

		i++;
	}
	i = 0;
	var timer = 7000;
	var p = document.getElementById('info');
	var nouv;

	function changer() {
		p.innerHTML = infos[i];
		p.innerHTML += "<br><a href='detail.php?id=" + infos_l[i] + "'" + ">voir plus</a>";
		p.style.color = 'teal';

		if (i < (infos.length - 1)) {
			i++;
		} else {
			i = 0;
		}

		setTimeout("changer()", timer)
	}
	window.onload = changer;
</script>