<ul id="categories">
<?php
foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['id_type_tel'];
	$libCategorie = $uneCategorie['libelle'];
	?>
		<a href=index.php?uc=administrer&categorie=<?php echo $idCategorie ?>&action=voirProduitsCategorie><?php echo $libCategorie ?></a> 	
<?php
}
?>
</ul>