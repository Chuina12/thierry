<?php

/**
 * @author [sylvain Tchouobou]
 * @email [support@creatis-dev.com]
 * @create date 05-03-2019 16:29:47
 * @modify date 05-03-2019 16:29:47
 * @desc [ ce fichier contient toute la configuration nécessaire pour uploader une image sans se soucier des details techniques]
 */
/**=============Inclusion du model produit========== */
include_once("model/produit.class.php");

/**============ PARAMETRES DE CONFIGURATION  */
function get_dest()
{
    //chemin des images du produit sur le serveur apres l'upload
    return  "../upload/";
}
function get_largeur()
{
    //largeur max de l'image en px
    return 1000;
}
function get_hauteur()
{
    //hauteur max de l'image en px
    return 300;
}

function get_taille_max()
{
    return 5242880;        // taille max de l'image (par defaut = 5M0)
}
function get_ext()
{
    return  ['jpeg', 'jpg', 'png']; // extensions acceptable
}
