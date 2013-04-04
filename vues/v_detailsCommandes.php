 <div id="produit" align="left"><center>
 <table height="50px" align="" width="100%">
 	<tr> 	  
		<td width="10%"  BGCOLOR="#B1221C"><div align="left"> </div></td> 
		<td width="10%"  BGCOLOR="#B1221C"><div align="left"><h3><center>libellés</div></td>	 
		<td width="10%"  BGCOLOR="#B1221C"><div align="left"><h3><center>Prix </div></td>
		<td width="10%"  BGCOLOR="#B1221C"><div align="left"><h3><center>Quantités</div></td>		 
	</tr>
<?php
 $i  = 0;
 @$num =$lesProduits[$nb-1]['num_commande']; 
 echo "<center><br>-------Commande n°$num_commande------<br></center>";
 foreach( $lesProduits as $unProduit) 
 {
	$num_commande = $unProduit['num_commande'];
	$id_produit = $unProduit['id_produit'];
	$nom = $unProduit['nom'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$quantite =$unProduit['quantite'];
	$id_couleur =$unProduit['id_couleur'];
	$id_produit =$unProduit['id_type_tel'];
	$date = $unProduit['date'];
	$date = date("F j, Y,");	
	$image = $unProduit['image_produit'];  
	if( $num_commande != $num)
	{
		echo "<center><br>--------------$date------<br>";
		$num = $num_commande;	 
	}
     if ($i < 4)
	{
		$i++;
 ?>	     	
	<tr> 	  
		<td width="10%"  BGCOLOR="#EFECCA"><div align="left"><img  width="100px" height="100px" src="<?php echo $image ?>"  alt=image /></div></td> 
		<td width="10%"  BGCOLOR="#B09F91"><div align="left"><center><h3><?php echo $nom ?></center></div></td>	 
		<td width="10%"  BGCOLOR="#B09F91"><div align="left"><h3><center><?php echo $prix." Euros" ?></center></div></td>
		<td width="10%"  BGCOLOR="#B09F91"><div align="left"><h3><center><?php echo $quantite ?></center></div></td>		 
	</tr> 
	</table> 
<?php
$num = $num_commande;
	} 
	if($i == 3)
	 { 
	    $i = 0;   
     }
?>
 <table height="50px" align="" width="100%">
<?php 
}
?>	
<center><a  onClick="history.back()" >Precedent</a>
</div>