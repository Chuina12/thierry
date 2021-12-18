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
    <!--link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"-->
</head>

<body>

    <div class="container">

        <div class="header">
            <?php include("entete.php") ?>
        </div>
        <div class="detail_content" style="border:1px solid #bbb;border-radius:4px;margin:30px;padding:10px;">
            <h2>Actualité sur nos offres!</h2>
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
                $id = $_GET['id'];
                $db = get_db_link();
                $res = $db->query("select * from actu where id=$id");
                $cursor = $res->fetch(PDO::FETCH_ASSOC);
                echo $cursor['message'];
                ?>
            </p>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>