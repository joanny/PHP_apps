<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- TITRE ET MENUS -->

<html lang="fr">
<head>
<title>Bienvenue chez .:I-Stick:.</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="util/my-css2.css" rel="stylesheet"  type="text/css">

<style>  
a{text-decoration:none}
</style>
</head>

<body>
<center>
<div id="entete">
<table width="100%" height="100px">
<tr width="60%">
<td width="40%" ><a href="index.php?uc=accueil"><strong><b1 class ="en_tete">.:I-Stick:.</a></b1></td>
 			<td width="20%"><div align="right"><a href="index.php?uc=administrer&action=connection_admin"><b2 class ="ans"><strong>Administrateur |</strong></b2> </a> 			 	
			 <a href="index.php?uc=administrer&action=newsletter"> <b2 class ="ans"><strong>newsletter</strong></b2> </a> 
			<?php if ((utilisateurConnecte()) ||  (@$_SESSION['admin'] == true ))
			{		
			?>		
			 <a href="index.php?uc=administrer&action=deconnection_admin"> <b2 class ="ans"><strong>| Deconnexion</strong></b2> </a></td>	
			<?php
			}
			?></div>
</tr>
<tr>
  
 <td COLSPAN=4> <center>
		<form    method="post" action="index.php?uc=voirProduits&categorie=null&action=rechercherProduit"> 
		<input type="text" value=""  maxlength="20"  class="input" height="12px" size="30" name ="recherche"><input type="submit" value="Rechercher"></form ></center></td>
 <?php	 	if(@$_SESSION['panier'])
			  { ?>
 
 <?php 
			}
?>
</tr>

</table>
</div>
 
