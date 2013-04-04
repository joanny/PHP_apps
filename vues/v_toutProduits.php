<div id="produitAdmin">
Trier par : <form method="post" action="index.php?uc=administrer&action=trierProduit&critere">
				<select name='tri'>	
				<option value="nom">Nom</option>			
				<option value="libelle">Categorie</option>				
				<option value="prix">Prix</option></select>
				<input type="submit" value="valider">
			</form>
<table   width="100%">
<tr border="5px">
	 <td  BGCOLOR="#B1221C"  width="10%"><div align="center"><h3>Nom</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Description</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Categorie</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Prix</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Image</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Activation</div></td>
	 
</tr>
<?php

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
		$activer = "<a href='index.php?uc=administrer&action=activerProduit&onoff=non&id=$id'  Onclick='confirm('Voulez désactiver ce produit ?');  '>Desactiver</a> ";			 
	}
	else
	{
		$activer = "<a href='index.php?uc=administrer&action=activerProduit&onoff=oui&id=$id' Onclick='confirm('Voulez activer ce produit ?'); '>Activer</a> ";	
	}
	?>		
	<tr> 	  		
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $nom ?></div></td>	 
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $description ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $categorie ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $prix ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><img src="<?php echo $image ?>"></div></td>	
		<td width="10%" BGCOLOR="#B09F91"><div align="center"><h3> <nav><larissa class="simpore"><?php echo $activer ?> </nav></a></div></td>			 		 
	</tr> 
	</table>
	<table  width="100%">
	
	<?php	
} 				 
?>	
<center> <a  onClick="history.back()" ><c2 class="texte">Retour au menu </c2></a>
</fieldset>
</div>
</ul>