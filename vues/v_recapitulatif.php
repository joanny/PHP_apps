<div  id="produit">
<fieldset>
<legend><h1>Confirmations de la commande</h1></legend>
<?php 
foreach ($utilisateur as $unUtilisateur )
{
?>
<h2>Souhaiter vous être livré(e) l'adresse suivante ?
<table> 
<tr width="40px"  height="50px">
	<td><h2>Rue:	<?php echo $unUtilisateur['rue'] ?></td>
</tr>
<tr>
	<td><h2>Ville:<?php echo $unUtilisateur['ville'] ?></td>
</tr>
<tr  width="40px"  height="50px">
	<td><h2>Code postale:<?php echo $unUtilisateur['code_postale'] ?></td>
</tr>
<tr  width="40px"  height="50px">
	<td> <a href="index.php?uc=gererPanier&action=confirmerCommande"><h2>Confirmer</a></td>
	<td> <a href="index.php?uc=administrer&action=modifierInscriptionUtilisateur"><h2>Modifier mes informations</a></td>
</tr>
</table>
</form>
<?php 
}
?>  
</fieldset>
</div>
