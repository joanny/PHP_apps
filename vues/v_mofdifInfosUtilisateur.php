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
 

<form  id="myForm" method="post" action="index.php?uc=administrer&action=validerInscriptionUtilisateur">
<?php if( $modiUtilisateur = true)
	{ 
?>
	
 <TABLE  height= "90px" width="980px" >
<TR>
  <TD width ="120px" rowspan="2"></TD> 
  <TD> <div align="left"> 
  <label class="form_col" for="nom"> <strong> nom </label>
  <input name="nom" id="nom" type="text"  value="<?php echo @$_SESSION['nom_utilisateur'];?>"/>
  <span class="tooltip"> Un nom ne peut pas faire moins de 2 caractères</span>
	  
 
  <TR>
  <TD><div align="left">  <label class="form_col" for="prenom"><strong> prenom</label>
            <input name="prenom" id="prenom" type="text" value="<?php echo @$_SESSION['prenom']; ?>" />	
      <span class="tooltip">Un prénom ne peut pas faire moins de 2 caractères</span> </TD> 
</TR>
  <TD rowspan="2"></td>
  <TD><label class="form_col" for="prenom"><strong>rue</label>
  <input id="rue" type="text" name="rue" value="<?php echo @$_SESSION['rue']; ?>"  size="30" maxlength="45">
			 <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>  </TD>  
	 
  <TR><TD> <label class="form_col" for="ville"><strong>ville</label>
         <input id="ville" type="text" name="ville" value="<?php echo @$_SESSION['ville']; ?>"   size="5" maxlength="5">
		  <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>   </TD>  </TR>
	 
 <TR> <TD width ="150px" rowspan="2"></TD>
 <td>  <label class="form_col" for="code_postale"><strong>code postale</label>
 <input id="code_postale" type="text" name="code_postale"  value="<?php echo @$_SESSION['code_postale']; ?>" size="10" maxlength="10">
    	   <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>
</td></TR>
  <TR>
  <TR>
  <TD rowspan="2"></td>
  <TD> <label class="form_col" for="pays"><strong>pays </label>
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
		 <span class="tooltip">Vous devez sélectionner votre pays de résidence</span>
</TD>  <TR>
  <TD> 
	  </TD>  </TR></TR>
  </TR>
  <TR>
  <TD rowspan="2"></td>
  <TD> <label class="form_col" for="date_naissance"><strong>date de naissance (jj/mm/aaaa) </label>
       
		<select name ="jour">
				<option value="01">1</option>
				<?php for ( $i = 2 ; $i <= 31 ; $i++)
				{
				?>
				  <option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php
				}
				?>
		</select>		
		<select name ="mois">
					<option value="1">Janvier</option>
					<option value="2">Février</option> 
					<option value="3">Mars</option>
					<option value="4">Avril</option> 
					<option value="5">Mai</option>
					<option value="6">Juin</option> 
					<option value="7">Juillet</option>
					<option value="8">Aout</option> 
					<option value="9">Septembre</option>
					<option value="10">Octobre</option> 
					<option value="11">Novembre</option>
					<option value="12">Décembre</option> 		
		</select>
	    	<select name = "annee" >
				 <option value="1975">1975</option>
				<?php for ( $i = 1976 ; $i <= 2005 ; $i++)
				{
				?>
				  <option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php
				}
				?>		 
			</select> 	
		 <TR>
  <TD><label class="form_col" for="adresse_mail"><strong>adresse électronique </label>
         <input id="mail" type="text"  name="mail" value="<?php echo @$_SESSION['adresse_electronique']; ?>"  size ="25" maxlength="25"> 
    </TD>  </TR></TR>
   <TR>
  <TD rowspan="2"></td>
  <TD><label class="form_col" for="mot_de_passe"><strong>Mot de passe :</label>  
  <input name="mot_de_passe" id="mot_de_passe" type="password" />
      <span class="tooltip">Le mot de passe ne doit pas faire moins de 6 caractères</span> 

	</TD>
  </TD>  <TR>
  <TD>   <label class="form_col" for="mot_de_passe2"> <strong>mot de passe :</label> 
  <input name="mot_de_passe2" id="mot_de_passe2" type="password" />
  <span class="tooltip">Les mot de passes doivent être identiques</span>
		</TD>  </TR></TR>
   <TR>
  <TD  rowspan="2"></td>
  <TD> <br></TD>  <TR>
  <TD> </TD>  </TR></TR>
  <TR>
   <TR>
  <TD  rowspan="2"></td>
  <TD> <span class="form_col"></span>
  <label><input name="news" type="checkbox" /><strong>  Je désire recevoir la newsletter chaque mois.</label></TD>  <TR>
  <TD><div align="center"><input type="submit" value="Valider" /> <input type="reset" value="Réinitialiser le formulaire" /></TD>  </TR></TR>
  <TR>
  </TR>
  </TR> 
</TR>		
</TABLE>
 <a  onClick="history.back()" >Precedent</a>
<?php
}
?>
<script>
// Fonction de désactivation de l'affichage des "tooltips"

function deactivateTooltips() {

  var spans = document.getElementsByTagName('span'),
      spansLength = spans.length;

  for (var i = 0 ; i < spansLength ; i++) {
    if (spans[i].className == 'tooltip') {
      spans[i].style.display = 'none';
    }
  }

}


// La fonction ci-dessous permet de r?p?r la "tooltip" qui correspond ?otre input

function getTooltip(el) {

  while (el = el.nextSibling) {
    if (el.className == 'tooltip') {
      return el;
    }
  }

  return false;

}


// Fonctions de v?fication du formulaire, elles renvoient "true" si tout est ok

var check = {}; // On met toutes nos fonctions dans un objet litt?l

 

check['nom'] = function(id) {

  var name = document.getElementById(id),
      tooltipStyle = getTooltip(name).style;

  if (name.value.length >= 2) {
    name.className = 'correct';
    tooltipStyle.display = 'none';
    return true;
  } else {
    name.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
    return false;
  }

};

check['prenom'] = check['nom'];  
check['rue'] = check['nom'];
check['ville'] = check['nom'];
check['age'] = function() {

  var age = document.getElementById('age'),
      tooltipStyle = getTooltip(age).style,
      ageValue = parseInt(age.value);

  if (!isNaN(ageValue) && ageValue >= 5 && ageValue <= 140) {
    age.className = 'correct';
    tooltipStyle.display = 'none';
    return true;
  } else {
    age.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
    return false;
  }

};

check['login'] = function() {

  var login = document.getElementById('login'),
      tooltipStyle = getTooltip(login).style;

  if (login.value.length >= 4) {
    login.className = 'correct';
    tooltipStyle.display = 'none';
    return true;
  } else {
    login.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
    return false;
  }

};

check['mot_de_passe'] = function() {

  var mot_de_passe = document.getElementById('mot_de_passe'),
      tooltipStyle = getTooltip(mot_de_passe).style;

  if (mot_de_passe.value.length >= 6) {
    mot_de_passe.className = 'correct';
    tooltipStyle.display = 'none';
    return true;
  } else {
    mot_de_passe.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
    return false;
  }

};

check['mot_de_passe2'] = function() {

  var mot_de_passe = document.getElementById('mot_de_passe'),
      mot_de_passe2 = document.getElementById('mot_de_passe2'),
      tooltipStyle = getTooltip(mot_de_passe2).style;

  if (mot_de_passe.value == mot_de_passe2.value && mot_de_passe2.value != '') {
    mot_de_passe2.className = 'correct';
    tooltipStyle.display = 'none';
    return true;
  } else {
    mot_de_passe2.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
    return false;
  }

};
check['code_postale'] = function() {

  var code_postale = document.getElementById('code_postale'),
      tooltipStyle = getTooltip(code_postale).style,
      code_postaleValue = parseInt(code_postale.value);

  if (code_postale.value.length == 5)   {
    code_postale.className = 'correct';
    tooltipStyle.display = 'none';
   return true;
  } else {
    code_postale.className = 'incorrect';
    tooltipStyle.display = 'inline-block';
     return false;
  }

};
check['pays'] = function() {

  var pays = document.getElementById('pays'),
      tooltipStyle = getTooltip(pays).style;

  if (pays.options[pays.selectedIndex].value != 'none') {
    tooltipStyle.display = 'none';
    return true;
  } else {
    tooltipStyle.display = 'inline-block';
    return false;
  }

};
check['date_naisssance'] = function() {
  var pays = document.getElementById('date_naissance'),
      tooltipStyle = getTooltip(pays).style;

  if (pays.options[pays.selectedIndex].value != 'none') {
    tooltipStyle.display = 'none';
    return true;
  } else {
    tooltipStyle.display = 'inline-block';
    return false;
  }

};



// Mise en place des ?nements

(function() { // Utilisation d'une fonction anonyme pour ?ter les variables globales.

  var myForm = document.getElementById('myForm'),
        inputs = document.getElementsByTagName('input'),
        inputsLength = inputs.length;

  for (var i = 0 ; i < inputsLength ; i++) {
    if (inputs[i].type == 'text' || inputs[i].type == 'password') {

      inputs[i].onkeyup = function() {
        check[this.id](this.id); // "this" repr?nte l'input actuellement modifi?      };

    }
  }

  myForm.onsubmit = function() {
    
    var result = true;

    for (var i in check) {
      result = check[i](i) && result;
    }

    if (result) {
      alert('Le formulaire est bien rempli.');
    }

    return false;
  
  };

  myForm.onreset = function() {
    
    for (var i = 0 ; i < inputsLength ; i++) {
      if(inputs[i].type == 'text' || inputs[i].type == 'password') {
      inputs[i].className = '';
      }
    }

    deactivateTooltips();
  
  };

})();


// Maintenant que tout est initialis?on peut d?ctiver les "tooltips"

deactivateTooltips();
</script>
