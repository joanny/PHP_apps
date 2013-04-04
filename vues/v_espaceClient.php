<div id="vue2">
   <fieldset>
     <legend><h1><strong>Espace client</strong></H1></legend>
 
	<form method="post" action="index.php?uc=administrer&action=<?php echo 'connexion_utilisateur' ?>"?nom="<?php echo @$_REQUEST['nom'];?>"&mdp="<?php echo @$_REQUEST['mdp'] ;?>">
	<table   width="60%" height="20%" >
			<th>
					
<?php				if (!utilisateurConnecte())
					{
?>				<tr>
					<td><a href="index.php?uc=administrer&action=seConnecter"><cat class="desir"><strong>Connexion</strong></cat></a></td> 
				</tr> 
				<tr> 
					<td><a href="index.php?uc=administrer&action=inscriptionUtilisateur"><cat class="desir"><strong>Inscription</strong></cat></a></td>
				</tr>  
<?php 
					}
					else
					{
?>				<tr>
						<td><a href="index.php?uc=gererPanier&action=voirPanier"><cat class="desir"><strong>Consulter mon panier</strong></cat></a></td> 
				</tr>
				<tr>
						<td><a href="index.php?uc=gererPanier&action=voirCommande"><cat class="desir"><strong>Historique de mes commandes</strong></cat></a></td> 
				</tr>	
				<tr>
						<td><a href="index.php?uc=administrer&action=modifierInscriptionUtilisateur"><cat class="desir"><strong>Modifier mes infos</strong></cat></a></td> 
				</tr>					 
				<tr>					   
					 <td><a href="index.php?uc=administrer&action=supprimerCompte"><cat class="desir"><strong>Supprimer mon compte</strong></cat></a></td> 
				</tr>				 								
			</th>
<?php
					}
					if (!utilisateurConnecte())
					{
?>					
	
	</table>
<?php
					}
?>
 </fieldset>
</div> 