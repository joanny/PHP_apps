<div id="vue"> 
<fieldset><legend><ajout class="produit">Ajouter un produit</ajout></legend>
<form method=post action="index.php?uc=administrer&action=ajout_du_produit">
<table width="100%" height=500px>
  <TR width="30%">	
		<Td><ajout class="produit">Emplacement de l'image:</Td>
		<Td><input type="file"  size="900px"  class="input" align="right"  maxlength="100000" name="image"></ajout></Td>		 
  </TR>
  </TR>
  <TR width="30%">		 
		<TD><ajout class="produit">Nom:</ajout></Td><Td><input class="input" type="text" size="30px"  name="nom"  ></TD> 
  </tr>
  <tr width="30%">		 
		<TD><ajout class="produit">Prix :</ajout></Td><Td><input type="text" size="10" class="input" 	name="prix"><ajout class="produit">€</ajout></TD>
  </tr>
  <TR width="30%">
  <TD><ajout class="produit">Code categorie:</ajout></TD>
  <TD>  <select   name="categorie">
			<?php foreach ( $lesCategories as $uneCategorie)
				{ ?>			 
				<option  value="<?php echo $uneCategorie['id_type_tel'] ?>" ><?php echo $uneCategorie['libelle'] ?></option>
				<?php 
				}
				?>
		</select>
	</td>						
	 <tr width="30%">   		 
	<TD><ajout class="produit"> Description :</ajout></td><Td> <textarea   class="input"  wrap="on" cols="90px"  style="font-weight:1000 color:yellow;" width="300px" name="description"></textarea>
</td>
</tr>
</table>	
<center><input class="button" value="valider" type="submit">
</form>
<a  onClick="history.back()" ><ajout class="produit">Retour au menu</ajout></a>
</fieldset>
</div>