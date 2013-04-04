<div id="vue">
<form method=post action="index.php?uc=administrer&action=valider_modification_du_produit">
<?php

foreach($leProduit as $unProduit) 
{
	$id = $unProduit['id_produit'];
	$nom = $unProduit['nom'];
	$description = $unProduit['description'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image_produit'];
	$categorie = $unProduit['id_type_tel'];
	?>
	
<TABLE frame="border" width="70%" height=300>
  <TR>
		<Td align="center" ><img src="<?php echo $image ?>" alt=image /></Th>
		<Td align="center"> <ajout class="produit"> chemin :</ajout><input type="text"  disabled  value="<?php echo $image ?>" size=50 name="image">
		<input type="hidden" name=id value= <?php echo $id ?> ></th>
  </TR>
  <TR  align="center">
   
		<TD><c2 class="texte"><?php echo $description ?></c2></TD>
		<Td> <textarea  wrap="on" cols="60px"  style="font-weight:2000 color:yellow;" width="1000px" name="description"> </textarea>
  </TD>
  </TR>
  <TR  align="center">
		<TD><?php echo $nom ;?></TD>
		<TD><input type="text" size=60  name="nom" value="<?php echo $nom ?>"></TD> 
  </TR>
  <TR  align="center">
		<TD><?php echo $prix." Euros" ?></TD>
		<TD>  <input type="text"  size=20 value="<?php echo $prix ?>" name="prix"><ajout class="produit"> €</ajout></TD>
  </TR>
		<TR  align="center">
		<TD><ajout class="produit"> Code categorie: </<ajout><?php echo  $categorie ?></TD>
   <TD>
			<select   name="categorie">
			<?php foreach ( $lesCategories as $uneCategorie)
			 { ?>
			 
				<option  value="<?php echo $uneCategorie['id_type_tel'] ?>" ><?php echo $uneCategorie['libelle'] ?></option>
			 <?php 
			 }
			 ?>
			 </select>
	<TR  align="center">
	   </TD>
	<TD>		 		
	</TD><TD>
		<center><input  class="button" value="valider" type="submit">
	</TD>
	</TR> 
  </TR> 
</TABLE>	
	</ul>

<?php
}
?>

</form>
 <a  onClick="history.back()" ><ajout class="produit"> Precedent</ajout></a>
</div>