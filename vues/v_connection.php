<div id="vue">
  <fieldset>
       <legend><h1><strong>Espace Administration</strong></H1></legend>
	 <?php  echo $message ?>
	<form method="post" action="index.php?uc=administrer&action=<?php echo 'validerConnection' ?>"?nom="<?php echo @$_REQUEST['nom'];?>"&mdp="<?php echo @$_REQUEST['mdp'] ;?>">
	<table   width="400px" height="200px">
			<th>		 
				<tr>	
						<td ><cat class="desir"><strong>Nom:</strong></cat> </td> 
						<td><input type="text" value="toto" name = "nom"></td> 
				</tr> 
				<tr>
					 <td ><cat class="desir"><strong>Mot de passe :</strong></cat></td> 
					 <td><input value="toto" type="text" name="mdp"></td> 
				</tr>
				<tr>
					 <td > </td> 
					 <td ><input type="submit" value="valider"></td> 
				</tr>
			</th>
	</table>
  </fieldset>
</div>
