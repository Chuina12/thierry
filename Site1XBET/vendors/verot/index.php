<?php
session_start();
include 'class.upload.php';
include  '../core.php';

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'send_image':
            echo save_image($_FILES);
            break;
        case 'delete_image':
            delete_image($_POST);
            break;
        default:
            break;
    }
}
function save_image($image)
{

    $dest = get_dest();
    $max_size = get_taille_max();
    $exts = get_ext();

    $handle = new Verot\Upload\Upload($image['qqfile']); //instance d'upload class

    if ($handle->uploaded) {

        //recuperation de l'extension et taille
        $ext = $handle->file_src_name_ext;
        $size = $handle->file_src_size;
        if (in_array($ext, $exts)) {
            if ($size > $max_size) {
                return '{"success":"false","message":"extension"}';
            } else {

                /*************** PARAMETRES *****************/
                $handle->file_auto_rename = false;
                $handle->image_resize = true;
                $handle->image_x = get_largeur();
                $handle->image_y = get_hauteur();
                $handle->image_ratio = true;
                $name = md5(uniqid(rand(), true));
                $handle->file_new_name_body = $name;
                $handle->image_brigthness = 10; // -127 à 127
                $handle->image_contrast = 20;   //  -127 à 127
                $handle->image_opacity = 100;    // 0 à 100;


                /*** COPIE DANS LE DOSSIER CIBLE ******/
                $handle->process($dest);
                if ($handle->processed) {

                    $_SESSION['produit_image'] = $handle->file_dst_name;

                    $handle->clean();
                    return '{"success":"true","uuid":"1234","message":"fichier enregistrer avec success!"}';
                } else {
                    return '{"success":"false","message":"chemin non fonctionnel"}';
                }
            }
        } else {
            return '{"success":"false","message":"extension"}';
        }
    } else {

        return '{"success":"false","error":"erreur enregistrement au serveur"}';
    }
}

function delete_image($post)
{

    if (isset($_SESSION['produit_image'])) {
        unlink(get_dest() . $_SESSION['produit_image']);
        $_SESSION['produit_image'] = "";
        return '{"success":"true"}';
    }
}
