<div id="produitAdmin" align="left"> 
  <fieldset>
     <legend><monlabel class="desir"><strong>Gestion des produits</strong></monlabel></legend>
		<table  width="100%" >
			<td width="80%" height="90px">
				<form method="post" action="index.php?uc=administrer&action=rechercherProduitAdmin"> 
					<c2 class="texte">Rechercher un Produit:</c2><input name="saisi" type="text">
					<input value="valider" type="submit">
				</form>
			</td>
			<td width="20%" align = "left">
			<form method="post" action="index.php?uc=administrer&action=trierProduit&critere">
			<c2 class="texte">Trier par :</c2><select name='tri'>
					<option value="nom">Nom</option>			
					<option value="libelle">Categorie</option>				
					<option value="prix">Prix</option>
				</select>
				<input type="submit" value="valider"> 
			</form>
			</td>
		</table>
<table  width="100%">
<tr>

     <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Image</div></td>
	 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Nom</div></td>
	 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Categorie</div></td>
	 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Description</div></td>
	 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Prix</div></td>
     <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Activation</div></td>
	 
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
		<td width="10%"  BGCOLOR="#EFECCA"><div align="left"><h3><img width="100px" height="100px" src="<?php echo $image ?>"></div></td>	
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $nom ?></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $categorie ?></div></td>	
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $prix ?></div></td>		
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><a href="index.php?uc=voirProduits&action=details&numProd=<?php echo $id ?>">Description</a></div></td>		
		<td width="10%" BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $activer ?></a></div></td>			 
	</tr> 
	</table>
	<table height="50px" width="100%">	
	<?php	
} 				 
?>	
<center> <a  onClick="history.back()" ><c2 class="texte">Retour au menu</c2> </a>
</fieldset>
</div>
</ul>