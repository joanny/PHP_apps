<div id="produit">
<?php
 $i  = 0;
 foreach( $leProduit as $unProduit) 
 {
	$id = $unProduit['id_produit'];
	$nom = $unProduit['nom'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image_produit'];
	$categorie = $unProduit['id_type_tel'];
	?>	
	<fieldset>
	<legend><c2 class="texte"><strong>Details</strong></c2></legend>
	<table  height="x"  align="center" width="80%">
		<tr>
			<th><img  width="250px" align="center" height="*px"  width="*px" src="<?php echo $image ?>"  alt=image /></th>			
			<th align="right" ><larissa class="simpore"><I><?php echo $description ?></I></larissa></th>			
		</tr>
		<tr>
			<th align="center" ><h2><i><?php echo $nom ?></i></h2></th>	
<?php    	 if ( @$_SESSION['admin'] == true )
		    { 					 
		?> 
		 <th>				
				<a href=index.php?uc=administrer&produit=<?php echo $id ?>&action=modifier_produit><c2 class="texte">modifer  ce produit</a>				
		 </th>
<?php		
			} 
?>
		</tr>
		<tr>
			<th align="center" ><h2><?php echo $prix." Euros" ?></h3></th>
				<?php 	
				if (!@$_SESSION['admin'])
				{
				?>
			<th> <a href=index.php?uc=gererPanier&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier> 
					 <img src="images/mettrepanier.png"  width="250px" TITLE="Ajouter au panier" ></a>				
		    </th>		 
		        <?php
				}
				else
				{
		?>					 														
					<th><a href=index.php?uc=administrer&produit=<?php echo $id ?>&action=ValiderSupprimerProduit onclick="return confirm('Voulez-vous vraiment retirer cet article ?');" ><c2 class="texte">supprimer  ce produit<c2 class="texte"></a></th>
		 </TR>
		<?php 
				}
		?>		 
	</table>
	<?php
	} 			 
?>	

<?php 
echo "<p><p><center>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
?>
