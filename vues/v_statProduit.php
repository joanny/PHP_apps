<div id="produitAdmin" align="left"> 
  <fieldset>
     <legend><monlabel class="desir"><strong>Statistisque des produits</strong></monlabel></legend>
		 
<table  width="100%">
<tr>

     <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Id</div></td>
	 <td  BGCOLOR="#F6E8B1"  width="10%"><div align="center"><h3><c2 class="texte"></div></td>	 
	 <td  BGCOLOR="#F6E8B1" width="10%"><div align="center"><h3><c2 class="texte">Prix</div></td>     
</tr>
</table>
<table height="50px" width="100%">	
<?php
foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['id_produit'];
	$image = $unProduit['image_produit'];
	$prix  = $unProduit['prix'];
	$nb = $unProduit['nbVente'];
 
	?>		
	<tr> 
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $id ?></div></td>		  
		<td width="10%"  BGCOLOR="#EFECCA"><div align="left"><h3><img width="100px" height="100px" src="<?php echo $image ?>"></div></td>		
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $prix ?></div></td>			 
		<td width="10%"  BGCOLOR="#B09F91"><div align="center"><h3><larissa class="simpore"><?php echo $nb ?></div></td>			 
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