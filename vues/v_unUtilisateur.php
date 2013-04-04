<div id="utilisateurs">
<fieldset>
<legend><h3>informations client</h3></legend>
<div align="right">
	<a href="index.php?uc=administrer&action=voirLesCommandesUtilisateur&id=<?php echo $_REQUEST['id_utilisateur'] ?>">Voir ses Commandes</a>
</div>
<table   width="100%">
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
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>nom</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $nom ?></div></td>
		</tr>
		<tr> 
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>prenom</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $prenom ?></div></td>	
		</tr> 
		<tr>	
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>ville</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $ville ?></div></td>
		</tr> 
		<tr>
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>code postale</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $codePostale ?></div></td>
		</tr> 
		<tr>
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>pays</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $pays ?></div></td>
		</tr>
		<tr>		
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>date de naissance</div> 
				<td width="10%"	 BGCOLOR="#B09F91"><div align="center"><h3><?php echo $date_naissance ?></div></td>
		</tr>
		<tr>
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>adresse electronique</div> 
				<td BGCOLOR="#B09F91"><div align="center"><h3><?php echo $adresse_electronique ?></div></td>
		</tr>		
		<tr>
				<td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>newsletter</div> 
				<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $newsletter ?></div></td>
		</tr>		 		
</table>
<?php	
} 				 
?>	
<center> <a  onClick="history.back()" >Retour au menu </a>
</fieldset>
</div>
