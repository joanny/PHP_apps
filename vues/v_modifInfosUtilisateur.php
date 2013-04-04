 <div id="vue2">
 <?php
 
  if(!empty($lesErreurs)){
	 foreach ( $lesErreurs  as $uneErreur )
	 {
?>
		 <table>
			 <th align="center">
				<h3>*</h3>
			 </th>
			 <th align="center">
				<h5><?php echo @$uneErreur;?></h5>
			 </th>
		  </table>
	 <?php
	 }
	 }
 ?> 
 

<form  id="myForm" method="post" action="index.php?uc=administrer&action=validerModifUtilisateur&id=<?php echo $_SESSION['id_utilisateur']?>">
<?php if( $modiUtilisateur = true)
	{ 
?>
	
 <TABLE  height= "90px" width="980px" >
<TR>
  <TD width ="120px" rowspan="2"></TD> 
  <TD>  
 
  <TR>
  <TD> 
      
</TR>
  <TD rowspan="2"></td>
  <TD><label class="form_col" for="prenom"><strong><c2 class="texte">rue</label>
  <input id="rue" type="text" name="rue" value="<?php echo @$_SESSION['rue']; ?>"  size="30" maxlength="45">
 	 
  <TR><TD> <label class="form_col" for="ville"><strong><c2 class="texte">ville</label>
         <input id="ville" type="text" name="ville" value="<?php echo @$_SESSION['ville']; ?>"   size="5" maxlength="5">
		  
 <TR> <TD width ="150px" rowspan="2"></TD>
 <td>  <label class="form_col" for="code_postale"><strong><c2 class="texte">code postale</label>
 <input id="code_postale" type="text" name="code_postale"  value="<?php echo @$_SESSION['code_postale']; ?>" size="10" maxlength="10">
    	   
</td></TR>
  <TR>
  <TR>
  <TD rowspan="2"></td>
  <TD> <label class="form_col" for="pays"><strong><c2 class="texte">pays </label>
		 <select name="pays" > 
							<option value="France" selected="selected">France </option>
							<option value="Afghanistan">Afghanistan </option>
							<option value="Afrique_Centrale">Afrique_Centrale </option>
							<option value="Afrique_du_sud">Afrique_du_Sud </option> 
							<option value="Albanie">Albanie </option>
							<option value="Algerie">Algerie </option>
							<option value="Allemagne">Allemagne </option>
							<option value="Andorre">Andorre </option>
							<option value="Angola">Angola </option>
							<option value="Anguilla">Anguilla </option>
							<option value="Arabie_Saoudite">Arabie_Saoudite </option>
							<option value="Argentine">Argentine </option>
							<option value="Armenie">Armenie </option> 
							<option value="Australie">Australie </option>
							<option value="Autriche">Autriche </option>
							<option value="Azerbaidjan">Azerbaidjan </option>
		 </select> 
		 
</TD>  <TR>
  <TD> 
	  </TD>  </TR></TR>
  </TR>
  <TR>
  <TD rowspan="2"></td>
  <TD>  	
		  	
		 <TR>
  <TD><label class="form_col" for="adresse_mail"><strong><c2 class="texte">adresse électronique </label>
         <input id="mail" type="text"  name="mail" value="<?php echo @$_SESSION['adresse_electronique']; ?>"  size ="25" maxlength="25"> 
    </TD>  </TR></TR>
   <TR>
  <TD rowspan="2"></td>
  <TD><label class="form_col" for="mot_de_passe"><strong><c2 class="texte">Mot de passe :</label>  
  <input name="mot_de_passe" id="mot_de_passe" type="password" />
       
	</TD>
  </TD>  <TR>
  <TD>   <label class="form_col" for="mot_de_passe2"> <strong><c2 class="texte">mot de passe :</label> 
  <input name="mot_de_passe2" id="mot_de_passe2" type="password" />
   
		</TD>  </TR></TR>
   <TR>
  <TD  rowspan="2"></td>
  <TD> <br></TD>  <TR>
  <TD> </TD>  </TR></TR>
  <TR>
   <TR>
  <TD  rowspan="2"></td>
  <TD> <span class="form_col"></span>
  <label><input name="news" type="checkbox" /><strong><c2 class="texte">  Je désire recevoir la newsletter chaque mois.</label></TD>  <TR>
  <TD><div align="center"><input type="submit" value="Valider" /> <input type="reset" value="Réinitialiser le formulaire" /></TD>  </TR></TR>
  <TR>
  </TR>
  </TR> 
</TR>		
</TABLE>
 <a  onClick="history.back()" ><c2 class="texte">Precedent</a>
<?php
}
?>  