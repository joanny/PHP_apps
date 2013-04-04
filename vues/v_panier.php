<div id="vue">

<h2> Votre Panier </h2>
<form method="post" action="index.php?uc=administrer&action=verification_information">
<table   width="100%">
<tr border="5px">
	 <td  BGCOLOR="#B1221C"  width="10%"><div align="center"><h3></div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Descriptions</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Quantité</div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3>Prix</div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3></div></td>      	 
</tr>
<?php
$lesid =array();
$i=0;
foreach( $lesProduitsDuPanier as $unProduit) 
{
	$id = $unProduit['id_produit'];
	$description = $unProduit['description'];
	$image = $unProduit['image_produit'];
	$prix = $unProduit['prix'];
	
	?>
	<td    width="10%"><div align="center"><h3><img src="<?php echo $image ?>" alt=image width=100	height=100 /></div></td>
	<td    width="10%"><div align="center"><h3><?php echo	$description; ?></div></td>
	<td    width="10%">
						<div align="center"><h3>quantite:<select name="quantite[<?php echo $id ?>]">
															<option value=1>1</option>
															<option value=2>2</option>
															<option value=3>3</option>
															<option value=4>4</option>
															<option value=5>5</option>
														</select>
						</div>
	</td>  
	<td    width="10%"><div align="center"><h3><?php echo	$prix." euros"; $lesid[$i] = $id; $i++ ?></div></td>	
	<td width="10%"><div align="center"><h3>
			<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article frais?');">
			<img src="images/fermer-icone-3746-128.png" width="50" TITLE="Retirer du panier" ></a>
			</div>
	</td> 	  
	<table   width="100%">
	<?php
}
?>
</table>
<input type="submit" value="valider">
</form>
</div>
