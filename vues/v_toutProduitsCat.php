<div id="produitAdmin">
<table   width="100%">
<tr border="5px">
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>id Produit</div></td>
	 <td  BGCOLOR="#B1221C"  width="10%"><div align="center"><h3>Nom</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Description</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Categorie</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Prix</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Image</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Activation</div></td>
	 
</tr>
<?php
$i  = 0;
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['id_produit'];
	$nom = $unProduit['nom'];
	$description = $unProduit['description'];
	$prix = $unProduit['prix'];
	$image = $unProduit['image_produit'];
	$activer = $unProduit['visible'];
	$categorie = $unProduit['libelle'];
	if ($activer == "oui")
	{
		$activer = "<a href='index.php?uc=administrer&action=activerProduit&onoff=non&id=$id'  Onclick='confirm('voulez désactiver cette utilisateur ?');  '>Desactiver</a> ";			 
	}
	else
	{
		$activer = "<a href='index.php?uc=administrer&action=activerProduit&onoff=oui&id=$id' Onclick='confirm('voulez désactiver cette utilisateur ?');'>Activer</a> ";	
	}
	?>		
	<tr> 	  
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $id ?></div></td> 
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $nom ?></div></td>	 
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $description ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $categorie ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><?php echo $prix ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><img src="<?php echo $image ?>"></div></td>	
		<td width="10%" BGCOLOR="#B09F91"><div align="center"><h3><?php echo $activer ?></a></div></td>			 
	</tr> 
	</table>
	<table  width="100%">
	
	<?php	
} 				 
?>	
<center> <a  onClick="history.back()" >Retour au menu </a>
</fieldset>
</div>
</ul>