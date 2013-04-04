<div id="vue2">
<fieldset>
<legend><h2><strong>Connection utilisateur</strong></H2></legend>
<?php echo $message ?>
	<form method="post" href="javascript:window.location.reload()" action="index.php?uc=administrer&action=<?php echo 'connexion_utilisateur' ?>"?nom="<?php echo @$_REQUEST['nom'];?>"&mdp="<?php echo @$_REQUEST['mdp'] ;?>">
	<table   width="400px" height="200px" >
			<th>
				<tr>	
						<td><cat class="desir"><strong>Adresse mail :</strong></cat> </td> 
						<td><input type="text" value="nom" name = "nom"></td> 
				</tr> 
				<tr>
					 <td ><cat class="desir"><strong>Mot de passe : </strong></cat></td> 
					 <td><input value=" "type="text" name="mdp"></td> 
				</tr>
				<tr> 
						<td></td>
					 <td> 
						<input type="submit"  value="valider"></td> 
						 
				</tr>
			</th>
	</table><a href="index.php?uc=administrer&action=inscriptionUtilisateur"><cat class="desir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inscription</u></cat></a></a>
</fieldset>
 <a  onClick="history.back()" ><h2>Précedent</h2></a>
</div>
