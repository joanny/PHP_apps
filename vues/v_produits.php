<div id="produit">
	<table align ="center"   width="800PX">
		<tr>
			<td align ="center"><?php   @$nombreProduits ?> </td>
		<tr>
	</table>
 
<?php
$i  = 0;
$nombreProduits = 0;
 foreach( $lesProduits as $unProduit) 
 {
	$nombreProduits ++;
	$id = $unProduit['id_produit'];
	$nom = $unProduit['nom'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image_produit'];
	$categorie = $unProduit['id_type_tel'];
    if ($i < 4)
	{
		$i++;
	?>	

	<table align ="left"   width="20%">
		<tr>
			<th><a href="index.php?uc=voirProduits&action=details&numProd=<?php echo $id ?>"><img  width="200px" align="center" height="200px" src=<?php echo $image ?>  alt=iimage /></a></th>	 
		</tr>
		<tr>
			<th align="center" ><c2 class="texte"><?php echo $nom ?></c2></th>	
		</tr>
		<tr>
			<th BGCOLOR="#570906" align="center" ><prix  class="lePrix"><?php echo $prix."€"?></prix>
				<?php 	
				if (!@$_SESSION['admin'])
				{
				?>   <a href=index.php?uc=gererPanier&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier> 
					 <img src="images/bt_add.gif
					 "  TITLE="Ajouter au panier" ></a>
				<?php
				}
				?>
			</th>
		</tr>
		<?php
	}
	if($i == 4)
	{ 
		$i = 0;   
	}
	if ( @$_SESSION['admin'] == true )
	{ 
	?>
		<tr>	
			<th><a href=index.php?uc=administrer&produit=<?php echo $id ?>&action=modifier_produit><c3 class="texte">modifer  ce produit</a><th>
		</tr>
		<tr>
			<th><a href=index.php?uc=administrer&produit=<?php echo $id ?>&action=ValiderSupprimerProduit onclick="return confirm('Voulez-vous vraiment retirer cet article ?');" ><c3 class="texte">supprimer  ce produit</a><th>
		</tr>
	</table>
	<?php
	}
  }
 ?>
  	<table align ="center"   width="800PX">
		<tr>
			<td align ="center"><?php  $nombreProduits ?> </td>
		<tr>
	</table>
	
</table>
</div>
