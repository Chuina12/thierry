<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Coupon 1XBET</title>
    <meta charset="utf-8">
    <meta name="Keywords" content="coupon 1XBET">
    <meta name="Author" content="coupon 1XBET">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link rel="shortcut icon" href="img\logoicon.ico">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

    <div class="container">

        <div class="header">
            <?php include("entete.php") ?>
        </div>
        <div class="text-center" style="border:1px solid #bbb;border-radius:4px;margin:30px;padding:10px;">
            <h2 class="text-center">Achat coupon N°CP00 <?php echo $_GET['coupon']; ?></h2>

            <p>
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
                $id = $_GET['coupon'];
                $db = get_db_link();
                $res = $db->query("select type,description,validite,prix from coupon where id=$id");
                $cursor = $res->fetch(PDO::FETCH_ASSOC);
                $description = $cursor['description'];
                $type = $cursor['type'];
                $prix = $cursor['prix'];
                $validite = date("d/m/Y à H:m", $cursor['validite']);
                echo $description;
                ?>
                <br> Veillez renseigner votre adresse email et une methode de payement pour recvoir par mail le lien du code bonus!
            </p>
        </div>
        <form action="traitement.php" method="post" name="frm">
            <input type="hidden" name="action" value="save_commande" />
            <input type="hidden" name="method_payment" value="" />
            <input type="hidden" name="total" value="<?php echo $prix; ?>" />
            <input type="hidden" name="id_coupon" value="<?php echo $id; ?>" />
            <div class="form-row">
                <div class="col-6">
                    <label for="">Votre nom</label>
                    <input type="text" name="nom" class="form-control" />
                </div>
                <div class="col-6">
                    <label for="">Votre email</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="col-12"><br><br>
                    <p class="text-center"><strong>Choisissez une methode de paiement!</strong>
                        <br>
                        <h3>Montant Total de la Facture : <?php echo $prix; ?>FCFA</h3>
                        <h4>Validité du code : <?php echo $validite; ?></h4>
                    </p>
                </div>
                <div class="col-4 border p-3">
                    <input type="radio" name="payment" id="p1" onclick="set('orange money')" />
                    <label for="p1">Orange Money</label>
                </div>
                <div class="col-4 border p-3">
                    <input type="radio" name="payment" id="p2" onclick="set('mobile money')" />
                    <label for="p2">MTN mobile money</label>
                </div>
                <div class="col-12"><br>
                    <input type="submit" class="btn btn-md btn-primary" value="enregistrer" />
                </div>

            </div>
        </form>
    </div>
    <script>
        function set(id) {
            document.frm.method_payment.value = id;

        }
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>