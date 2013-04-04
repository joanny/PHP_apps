<div id="produitAdmin" align="left">
  <fieldset>
     <legend><monlabel class="desir">Les Commandes </legend>
 <table   width="100%">
	 <tr border="5px">
		 <td  BGCOLOR="#F6E8B1" width="10%"><div align="left"><h3><center><c2 class="texte">Commande</div></td>
		 <td  BGCOLOR="#F6E8B1"  width="10%"><div align="left"><h3><center><c2 class="texte">Date</div></td>
		 <td  BGCOLOR="#F6E8B1" width="10%"><div align="left"><h3> <center><c2 class="texte">Utilisateur </div></td>  
		 <td  BGCOLOR="#F6E8B1" width="10%"><div align="left"><h3><center><c2 class="texte">Details commande</div></td>
	</tr>
<?php
 	 foreach( $lesCommandes as $uneCommande) 
	 {
		$num_commande = $uneCommande['num_commande'];
		$date= $uneCommande['date'];
		$date = dateEnChaine($date );	
		$id_utilisateur = $uneCommande['id_utilisateur'];
		$id_produit =$uneCommande['id_produit'];
		$quantite =$uneCommande['quantite'];
	 ?>
	<tr> 	  
		<td width="20%"  BGCOLOR="#B09F91"><div align="left"><h3><center><larissa class="simpore"><?php echo $num_commande?></div></td> 
		<td width="20%"  BGCOLOR="#B09F91"><div align="left"><h3><center><larissa class="simpore"><?php echo $date ?></div></td>	 
		<td width="20%"  BGCOLOR="#B09F91"><div align="left"><h3><a href="index.php?uc=administrer&action=voirUtilisateur&id_utilisateur=<?php echo $id_utilisateur ?> "><center><larissa class="simpore"><?php echo $id_utilisateur ?></a></div></td>			
		<td width="20%"  BGCOLOR="#B09F91"><div align="left"><h3><a href="index.php?uc=administrer&action=voirLesDetailsCommandes&num_commande=<?php echo $num_commande ?>"><center><larissa class="simpore">Details</a></div></td>			
	</tr> 
 </table>		  
	 <table   width="100%">
	 <?php 	  
	}
?>	
</fieldset>
 <center><a  onClick="history.back()"><c2 class="texte">Retour au menu</c2> </a>
</div>
