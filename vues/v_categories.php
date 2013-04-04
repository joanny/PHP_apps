<DIV id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['id_type_tel'];
	$libCategorie = $uneCategorie['libelle'];
	?>
		<a href=index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits><c4 class="texte"> |<strong> <?php echo  $libCategorie ?></strong></a> 	
<?php
}
?>
</div>
