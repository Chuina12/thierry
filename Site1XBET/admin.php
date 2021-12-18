<?php session_start(); ?>
<! doctype html>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>Espace administrateur</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    </head>

    <body style="background:linear-gradient(#bbb,#222256);">
        <marquee style="color: red">
            <h1>Attention espace administrateur !!</h1>
        </marquee>

        <?php
        ob_start();
        ?>
        <div class="container">
            <div class="row " style="margin-top:10%;">
                <div class="m-auto col-8 border rounded bg-white p-3">
                    <h5>Authentifiez-vous !</h5><br>
                    <form method="post" action="admin.php">
                        <input type="hidden" name="action" value="connexion" />
                        <table>
                            <tr>
                                <td><label>Telephone : </label></td>
                                <td><input type="tel" class="form-control" name="tel" REQUIRED /></td>
                            </tr>
                            <tr>
                                <td> <label>Mot de passe : </label></td>
                                <td><input type="password" class="form-control" name="password" REQUIRED /></td>
                            </tr>
                        </table><br>
                        <input type="submit" class="btn btn-md btn-danger" value="connexion" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        $conexion = ob_get_clean();
        ob_start();
        ?>
        <div class="container">
            <div class="row " style="margin-top:10%;">
                <div class="m-auto col-8 border rounded bg-white p-3">
                    <h5>Creer un compte administrateur!</h5>
                    <p>Cette operation ne peut se faire qu'une seule fois pour toujours.</p>
                    <form method="post" action="admin.php">
                        <input type="hidden" name="action" value="create" />
                        <table>
                            <tr>
                                <td><label>Telephone : </label></td>
                                <td><input type="tel" class="form-control" name="tel" REQUIRED /></td>
                            </tr>
                            <tr>
                                <td> <label>Mot de passe : </label></td>
                                <td><input type="password" class="form-control" name="password" REQUIRED /></td>
                            </tr>
                            <tr>
                                <td> <label>Confirmer Mot de passe : </label></td>
                                <td><input type="password" class="form-control" name="password2" REQUIRED /></td>
                            </tr>
                        </table><br>
                        <input type="submit" class="btn btn-md btn-primary" value="enregistrer" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        $create = ob_get_clean();

        //  section d'initialisation
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
        // verification d'existence de l'admin
        $dbl = get_db_link();
        $res = $dbl->query("select * from admin where 1");
        $cursor = $res->fetchAll();
        if (count($cursor)) {
            // demande d'authenfication de l'admin
            echo $conexion;
        } else {
            echo $create;
        }

        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'connexion':
                        $tel = intval($_POST['tel']);
                        $pass = $_POST['password'];
                        $res = $dbl->query("select *from admin where telephone = $tel");
                        $cursor = $res->fetchAll();
                        if (count($cursor)) {
                            if ($cursor[0]['password'] == sha1($pass)) {
                                $_SESSION['admin_check_up'] = "SUCCESS_AUTHENTICATE";
                                header('location:administrateur.php');
                            } else {
                                echo "<div class='container mt-3'><h4 class='bg-white border rounded text-danger p-2'>
                                votre mot de passe est incorrecte!</h4></div>";
                            }
                        } else {
                            echo "<div class='container mt-3'><h4 class='bg-white border rounded text-danger p-2'>
                                votre numero de telephone est incorrecte</h4></div>";
                        }
                        break;
                    case 'create':
                        if ($_POST['password'] != $_POST['password2'])
                            echo "<div class='container mt-3'><h4 class='bg-white border rounded text-danger p-2'>Les deux mots de passe doivent correspondre!</h4></div>";
                        else {
                            $pass = sha1($_POST['password']);
                            $tel = intval($_POST['tel']);
                            //enregistrement de l'admin
                            if ($dbl->exec("insert into admin(telephone,password)values($tel,'$pass')")) {
                                echo "<div class='container mt-3'><h4 class='bg-white border rounded text-danger p-2'>
                            Le compte admin à été enregistré avec  succes!</h4>
                            <p><a href='admin.php'class='btn btn-md btn-dark'>Connexion?</a></p>
                            </div>";
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        ?>


        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>