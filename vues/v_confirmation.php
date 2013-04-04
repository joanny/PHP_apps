<div id="vue2">
<fieldset>
<legend><h2>Confirmation</h2></legend>
<?php echo $message;   ?>
	<form method="post"  action="index.php?uc=administrer&action=<?php echo 'confirmationSuppresionCompte' ?>"?confirm="<?php echo @$_REQUEST['confirm'];?>>
	<table   width="405px" height="200px" >
			<th>
				<tr>	
						<td width="405px"><c2 class="texte">Souhaitez vous vraiment supprimer votre compte  ?  </c2></td> 
						<td><select  name="confirm" type="checkbox" /> 
							<option   value="non"><c2 class="texte">non</c2></option>
							<option value="oui"><c2 class="texte">oui</c2></option>
						    </select>
						</td> 
				</tr> 
				<tr> 
						<td></td>
						<td><input type="submit"  value="valider"></td>						 						
				</tr>
			</th>
	</table> 
</fieldset>
</div>
