<div id="produit" align="left">
<?php
 $i  = 0;
 @$num =$lesProduits[$nb-1]['num_commande'];
 if (!(isset($num )))
 {
 echo "<center>aucune commande passée à ce jour";
 }
 else
 {
 ?>
 <textfield>
 
 <table   width="100%">
<tr border="5px">
     <td  BGCOLOR="#570906" width="10%"><div align="center"><h3></div></td>
	 <td  BGCOLOR="#B1221C"  width="10%"><div align="center"><h3><c2 class="texte">Nom</c2></div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Prix</c2></div></td>
	 <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Quantité</c2></div></td>
     <td  BGCOLOR="#B1221C" width="10%"><div align="center"><h3><c2 class="texte">Description</c2></div></td>
</tr>
<?php
 echo "<center><h1><br>-------Vos commandes------<br></h1>";
 foreach( $lesProduits as $unProduit) 
 {
		$id = $unProduit['id_produit'];
		$nom = $unProduit['nom'];
		$description = $unProduit['description'];
		$prix=$unProduit['prix'];
		$num_commande =$unProduit['num_commande'];
		$date = $unProduit['date'];
		$date = dateEnChaine($date );	
		$image = $unProduit['image_produit'];
		$quantite = $unProduit['quantite'];  
		$description = $unProduit['description'];
		if( $num_commande != $num)
		{
			echo "<br><legend><h2>----$date----</h2></legend><br>";
			$num = $num_commande;
		}
	?> 
		<tr border="5px">
			 <td  BGCOLOR="" width="10%"><div align="center"><h3><a href="index.php?uc=voirProduits&action=details&numProd=<?php echo $id ?>"><img width="150px" height="150px" src="<?php echo $image ?>"  /></a></div></td>
			 <td  BGCOLOR="#F6E8B1"  width="10%"><div align="center"><h3><larissa class="simpore"><?php echo $nom ?></larissa></div></td>
			 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><larissa class="simpore"><?php echo $prix." Euros" ?></div></td>
			 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><larissa class="simpore"><?php echo $quantite ?></div></td>
			 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><larissa class="simpore"><a href="index.php?uc=voirProduits&action=details&numProd=<?php echo $id ?>">Description</a></div></td>
		</tr>
	</table>		
	<table   width="100%">  
	<?php
	$num = $num_commande;
	} 
}
?>
</textfield>
<center> <a  onClick="history.back()" ><h3><c2 class="texte">Précedent</c2></h3> </a>	
</div>