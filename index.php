<link rel="shortcut icon" type="image/x-icon" href="images/marquee_background.jpg" />

<?php

session_start();

session_set_cookie_params(3);

require_once("util/fonctions.inc.php");
require_once("util/class.PdoMystick.inc.php");
include("vues/v_panneauDroit.php");
include("vues/v_panneauGauche.php");
include("vues/v_entete.php") ;
include("vues/v_bandeau.php") ;
$message = "";
if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];
$pdo = PdoMystick::getPdoMystick();	 
switch($uc)
{
	case 'accueil':
		{include("vues/v_accueil.php");		 
		 include("vues/v_pied.php");
		break;}
	case 'voirProduits' :
		{include("controleurs/c_voirProduits.php");break;}
	case 'gererPanier' :
		{ include("controleurs/c_gestionPanier.php");break; }
	case 'administrer':
	  	{include("controleurs/c_gestionProduits.php");break;}
} 
?>

