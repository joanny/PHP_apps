<div id="produitAdmin">
<fieldset>
  <legend><monlabel class="desir"><strong>Les utilisateurs</strong></monlabel></legend>
<div align="right">
	<form method="post" action="index.php?uc=administrer&action=rechercherUtilisateur">
	<input type="text" name="info">
	<input type="submit" value="Rechercher un utilisateur"></form>
</div>
<table   width="100%">
<tr border="5px">
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Nom</div></td>
	 <td  BGCOLOR="#B1221C"  width="10%"><div align="center"><h3><c2 class="texte">Prenom</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Ville</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Code postale</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Pays</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"> <h3>Date de naissance</div></td>
	 <td  BGCOLOR="#B1221C"  ><div align="center"><h3><c2 class="texte">Adresse mail</div></td>    
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Newsletter</div></td>
	 <td  BGCOLOR="#570906" width="10%"><div align="center"><h3></div></td>
</tr>
<?php
 foreach( $lesUtilisateurs as $unUtilisateur) 
 {
	$id = $unUtilisateur['id_utilisateur'];
	$nom = $unUtilisateur['nom_utilisateur'];
	$prenom = $unUtilisateur['prenom'];
	$rue = $unUtilisateur['rue'];
	$ville = $unUtilisateur['ville'];
	$codePostale = $unUtilisateur['code_postale'];
	$pays = $unUtilisateur['pays'];
	$date_naissance = $unUtilisateur['date_naissance'];
	$adresse_electronique = $unUtilisateur['adresse_electronique'];
	$mot_de_passe = $unUtilisateur['mot_de_passe'];
	$newsletter = $unUtilisateur['newsletter'];
	$activer = $unUtilisateur['activer'];
    if ($activer == "oui")
	{
		$activer = "<a href='index.php?uc=administrer&action=supprimerUtilisateur&onoff=non&id=$id'  Onclick='confirm('voulez désactiver cette utilisateur ?');  '>Desactiver</a> ";			 
	}
	else
	{
		$activer = "<a href='index.php?uc=administrer&action=supprimerUtilisateur&onoff=oui&id=$id' Onclick='confirm('voulez désactiver cette utilisateur ?');'>Activer</a> ";	
	}
	?>		
	<tr> 	  
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $nom ?></div></td> 
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $prenom ?></div></td>	 
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $ville ?></div></td>
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $codePostale ?></div></td>
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $pays ?></div></td>
		<td width="10%"	 BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $date_naissance ?></div></td>
		<td BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $adresse_electronique ?></div></td>		 
		<td width="10%"  BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $newsletter ?></div></td>
		<td width="10%" BGCOLOR="#F6E497"><div align="center"><h3><larissa class="simpore"><?php echo $activer ?></a></div></td>			 
	</tr> 
</table>
<table  width="100%">
	<?php	
} 				 
?>	
<center> <a  onClick="history.back()" ><c2 class="texte">Retour au menu</c2> </a>
</fieldset>
</div>
