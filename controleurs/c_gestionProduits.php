<?php
$action =$_REQUEST['action'];
switch ($action)
{
															//ADMINISTRATEUR
// connexion administrateur //
	case 'connection_admin' : 
	{ 
		$lesCategories = $pdo->getLesCategories();	
		if (@$_SESSION['admin'] == true)
		{
			$lesCategories = $pdo->getLesCategories();
			include('vues/v_accueilAdmin.php');				
		}
		else
		{
			include ('vues/v_connection.php');
		}	
		break;
	}
	case 'voirToutLesProduits':
	{
		$lesProduits = $pdo->getProduits();
		$lesCategories = $pdo->getLesCategories();
		//include('vues/v_categoriesAdmin.php');
		include('vues/v_produitsAdmin.php');

		break;
	}
	// rechercher un prod
	
    case'rechercherProduitAdmin' :
	{
		$saisi = $_REQUEST['saisi'];
		$lesProduits = $pdo->rechercherProduitAdmin($saisi);
		
		if (  $saisi != "")
			{
			if ($lesProduits == null)
			{   
				$message = "aucun produit pour <u>$saisi</u>" ;
				$lesCategories = $pdo->getLesCategories();
				
				include('vues/v_message.php');
				$lesProduits = $pdo->getProduits();
				$lesCategories = $pdo->getLesCategories();			 
				include('vues/v_produitsAdmin.php');					
			}
			else
			{   $message = "Resultat de votre recherche pour :<u>$saisi</u> ";
				include('vues/v_message.php');
				include('vues/v_produitsAdmin.php');
			}
		}
		else
		{
			$lesProduits = $pdo->getProduits();
			$lesCategories = $pdo->getLesCategories();			 
			include('vues/v_produitsAdmin.php');
		}
		break;
	}
// valider la connexion // 
	case 'validerConnection':
	{	
				//var_dump($_REQUEST);
				@$nom = $_REQUEST['nom'];
				@$mdp = $_REQUEST['mdp'];
				$ladmin = $pdo->connection($nom,$mdp);
				if ($ladmin)
				{	enregAdmin();
				    estConnecter();
				 	$lesCategories = $pdo->getLesCategories();
					include("vues/v_accueilAdmin.php");	
							?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=administrer&action=connection_admin">
<?php					
				}
				else 
				{ 
				  $message = "les informations saisis ne sont nous permettent pas de nous identifier";
				  include ('vues/v_connection.php');
				}
		break;
	}
	case 'voirUtilisateur' :
	{
		$idUtilisateur = $_REQUEST['id_utilisateur'];
		$lesUtilisateurs = $pdo->getUtilisateur($idUtilisateur );
		include('vues/v_unUtilisateur.php');
	    break;
	}
// deconnexion de l administrateur //
	case  'deconnection_admin':
	{   $_SESSION['admin'] = false;
		$dec = $pdo->deconnection();
	?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=accueil">
	<?php
		break;
	}
	case 'voirLesUtilisateurs':
	{
		$lesUtilisateurs = $pdo->getLesUtilisateurs();
		arsort($lesUtilisateurs);
		include('vues/v_lesUtilisateurs.php');
		break;
	}
	case 'supprimerUtilisateur':
	{
		$onoff = $_REQUEST['onoff'];
		$id = $_REQUEST['id'];
 		$exec = $pdo->DroiUtilsateur($id , $onoff);
?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=administrer&action=voirLesUtilisateurs">
<?php
		break;
	}
	case 'rechercherUtilisateur' :
	{
		$info = $_REQUEST['info'];
		$lesUtilisateurs = $pdo->RechercheUtilisateur($info);
		$nb = count ($lesUtilisateurs);		 
		if ($nb >0)
		{
			include('vues/v_lesUtilisateurs.php');
		}
		else
		{
			$message = "ces informations ne correspondent à aucun utilisateur";
			include('vues/v_message.php');
			$lesUtilisateurs = $pdo->getLesUtilisateurs();
			include('vues/v_lesUtilisateurs.php');			
		}
		break;
	}
																		//PRODUIT 
// modification d'un produit // 
	case 'modifier_produit' :
	{
		
		$idProduit = $_REQUEST['produit'];
		$leProduit = $pdo->getLeProduit($idProduit);
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_modifierProduits.php");
		break;
	}	
	case 'ajout_produit' :
	{   
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_ajoutProduit.php");
		break;
	}
// valider modification //
	case 'valider_modification_du_produit': 
	{    
		$id = $_REQUEST['id'];
		$nom = $_REQUEST['nom'];		
		$description = $_REQUEST['description'];
		$prix = $_REQUEST['prix'];		 
		$categorie = $_REQUEST['categorie'];		 
		$modif = $pdo->modifierProduit($id ,$nom ,$description , $prix , $categorie );		 
		if ($modif == true ) 
		{	 
			$lesCategories = $pdo->getLesCategories();
			include("vues/v_categories.php");
			$message = "Le produit n° $id à été modifié avec succès"; 	 
			$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
			include('vues/v_message.php');
			include("vues/v_produits.php");
		}
		else
		{   	 
			$message ="Le produit numero ".$id."  n'a pu etre  modifer";  
			$leProduit = $pdo->getLeProduit($id);
			$lesCategories = $pdo->getLesCategories();
			include('vues/v_message.php');
			include("vues/v_modifierProduits.php");
		}
			
		break;
	}
// ajouter d un produit //
	case 'ajout_du_produit': 
	{    		 
		$nom = $_REQUEST['nom'];		
		$description = $_REQUEST['description'];
		@$image = $_REQUEST['image'];
		$image = "images_produits/image_test/$image";
		$prix = $_REQUEST['prix'];
		$categorie = $_REQUEST['categorie'];
		$ajout = $pdo->ajoutProduit( $nom ,$description , $image , $prix , $categorie );			 
		if ($ajout == true ) 
		{	 
			$message = "Le produit   à été ajouté avec succès"; 	 
			$lesProduits = $pdo->getLesProduitsDeCategorie(5);
			include("vues/v_message.php");
			include("vues/v_produits.php"); 
		}
		else
		{   	  
			$message ="Le produit n'a pu etre  ajouter"; 
			$lesCategories = $pdo->getLesCategories($categorie);
			include("vues/v_message.php");
			include("vues/v_ajoutProduit.php");
		}
		break;
	}
 
// suppression d un produit // 
	case 'supprimerProduit':
	{ 	$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
		 
		break;
	}	
// validation de la suppression //
	case 'ValiderSupprimerProduit':
	{ 
		$id = $_REQUEST['produit'];	   
		$sup = $pdo->supprimerProduit( $id );
		$lesProduits = $pdo->getLesProduitsDeCategorie(5);
		if ($sup)
		{ 
			$message ="Le produit  $id à été supprimer ";  
			$lesCategories = $pdo->getLesCategories();
			include('vues/v_message.php');
			include("vues/v_categories.php");		
			include('vues/v_produits.php');
		}
		else
		{
			$message ="Le produit $id  n'a pu etre supprimer  car il à été commander "; 
			$lesCategories = $pdo->getLesCategories();
			include("vues/v_message.php");
			include("vues/v_categories.php");
			include("vues/v_produits.php");			
		}
		break;
	}
	case 'voirLesCommandes':
	{
		$lesCommandes = $pdo->getLesCommandes();
		arsort($lesCommandes);
		include('vues/v_LesCommandes.php');
		break;
	}
	case 'voirLesCommandesUtilisateur':
	{
			@$id_utilisateur = $_REQUEST['id'];
			$lesProduits = $pdo->getCommande($id_utilisateur);
			$nb = count($lesProduits);
			$lesProduits = array_reverse($lesProduits);			
			include('vues/v_commande.php');	
			break;
	}
	case 'voirLesDetailsCommandes':
	{
		$num_commande = $_REQUEST['num_commande'];
		$lesProduits = $pdo->getDetailsCommandes($num_commande);
		include('vues/v_detailsCommandes.php');
		break;
	}
																//UTILISATEUR 
// connexion utilisateur // 
	case 'connexion_utilisateur':
	{ 		 
	 	$nom = $_REQUEST['nom'];
		$mdp = $_REQUEST['mdp'];
		$connexion = $pdo->connexionUtilisateur($nom ,$mdp );
	 	if ($connexion)
		{     
			 utilisateurConnecte();
			include('vues/v_espaceClient.php');
			?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=administrer&action=choixIdentification">
<?php
		}
		else
		{
			$message = "<h3>Il semblerait que vous ayez mal orthographié votre adresse électronique ou votre mot de passe.</H3>";
			include ("vues/v_connection_utilisateur.php");
			$_SESSION['panier'] = false;			
		}  
		break;	
	}	
// affiche la vue de connexion ou l espace client // 	
	case 'seConnecter':
	{	
		if (!utilisateurConnecte())
		{
			include ("vues/v_connection_utilisateur.php");	
		}
		else 
		{
			include('vues/v_message.php');
		    include('vues/v_inscription.php');
		}
		break;
	}
// choix identification // 
	case 'choixIdentification':
	{
		include('vues/v_espaceClient.php');
		break;
	}
// verification des information avant validation de la commande // 
	case 'verification_information':	
	{	
		$_SESSION['quantite']=  $_REQUEST['quantite'];
		if (utilisateurConnecte())
		{
			$id = $_SESSION['id_utilisateur'];			
			$utilisateur = $pdo->getUtilisateur($id);
		 	include('vues/v_recapitulatif.php');
		}
		else
		{
			$message ="veuillez vous inscrire pour continuer";
			include("vues/v_message.php");
			include ("vues/v_connection_utilisateur.php");
		}	
	break;
	}
// inscription de l utilisateur // 
	case 'inscriptionUtilisateur':
	{ $lesErreurs = array();
	  $exec = true;
	  include('vues/v_inscription.php');
	   break;
	}
// modification des infos de l utilisateur // 
	case 'modifierInscriptionUtilisateur':
	{ $modifUtilisateur = true;
	  $lesErreurs = array();
	  include('vues/v_modifInfosUtilisateur.php');
	  break;
	}	
// affiche la vue newsletter //
	case 'newsletter':
	{ 
    	include('vues/v_newsletter.php');
	    break;
	}
// validation de l adr mail //
	case 'valideNewsletter':
	{   
		$mail = $_REQUEST['mail'];
		if ( $mail != "")
		{
			$ok = estUnMail($mail);
			if (!$ok)
			{	
				$message = "L'adresse mail est incorrecte";
				include('vues/v_message.php');
				include('vues/v_newsletter.php');
			}
			else
			{
				$message = $pdo->newsletter($mail);	
				include('vues/v_message.php');
				include('vues/v_newsletter.php');
			}
		}
		else
		{
			include("vues/v_newsletter.php");
		}
	    break;
	}
// validation de l inscription //
	case 'validerInscriptionUtilisateur':
	{   $connecter = false ;
		$newsletter = "non";
		$nom = $_REQUEST['nom'];
		@$news = $_REQUEST['news'];	
		$prenom = $_REQUEST['prenom'];
		$rue = $_REQUEST['rue'];
		$ville = $_REQUEST['ville'];
		$codePostale = $_REQUEST['code_postale'];
		$pays = $_REQUEST['pays'];
		$jour = $_REQUEST['jour'];
		$mois = $_REQUEST['mois'];
		$annee = $_REQUEST['annee'];	 
		$dateNaissance = convertDate($jour,$mois,$annee);	
		$mail = $_REQUEST['mail'];
		$mdp = $_REQUEST['mot_de_passe'];
		$mdp2 = $_REQUEST['mot_de_passe2'];
		$activer = "oui";
		if ($news)
		{
		  $newsletter = "oui";
		}
		$utilisateurExist = $pdo->verifDoublons($nom , $prenom ,$rue , $ville , $codePostale ,	$pays , $dateNaissance ,$mail , $mdp ,$mdp2  );
		if ($utilisateurExist)
		{
			$lesErreurs = getErreursSaisieCommande($nom,$rue,$ville,$codePostale,$mail, $mdp ,$mdp2);			
			if ( $lesErreurs  == NULL)
			{
				$inscription = $pdo->inscrireUtilisateur( $nom , $prenom ,
				$rue , $ville , $codePostale ,
				$pays , $dateNaissance ,
				$mail , $mdp ,$newsletter , $activer);				 
				 if ($inscription)
				 {	
					$connexion = $pdo->connexionUtilisateur($nom ,$mdp );
					$message = "vous avez été inscrit avec succes";
					enregUtilisateur(); 				 
					include("vues/v_message.php");
					include("vues/v_espaceClient.php");
				 }
				 else
				 {  					 
					include('vues/v_inscription.php');
				 }
			}
			else
			{
			 $lesErreurs = getErreursSaisieCommande($nom,$rue,$ville,$codePostale,$mail,$mdp,$mdp2);
			 include('vues/v_inscription.php');
			}
		}
		else
		{
			$lesErreurs = getErreursSaisieCommande( "aa" ,"aa" ,"aa",88888,"mail@gmail.dee","aa","aa");
			$message = "cet utilisateur est déjà enregistré";
			include('vues/v_message.php');			
			include('vues/v_inscription.php');
			
		}
		break;
	}
	case 'validerModifUtilisateur':
	{   
		$id_utilisateur =  $_REQUEST['id'];  		 
		$newsletter = "non";		 
		@$news = $_REQUEST['news'];		
		$rue = $_REQUEST['rue'];
		$ville = $_REQUEST['ville'];
		$codePostale = $_REQUEST['code_postale'];
		$pays = $_REQUEST['pays'];
		$mail = $_REQUEST['mail'];
		$mdp = $_REQUEST['mot_de_passe'];
		$mdp2 = $_REQUEST['mot_de_passe2'];
		 
		if ($news)
		{
		  $newsletter = "oui";
		}	
			$lesErreurs = getErreursSaisieCommande( "aa" ,"aa" ,$ville,$codePostale,$mail, $mdp ,$mdp2);			
			if ( $lesErreurs  == NULL)
			{
				$modif = $pdo->updateUtilisateur( $id_utilisateur , $rue , $ville , $codePostale ,$pays ,	$mail , $mdp ,$newsletter  );														 		 		
				 if ($modif)
				 {	
					include('vues/v_message.php');
					include('vues/v_espaceClient.php');
						$mod = $pdo->connexionUtilisateur(  $_SESSION['nom_utilisateur'] , $mdp );
				 }				   
			}
			else
			{				
				 include('vues/v_modifInfosUtilisateur.php');
			}		 
		break;
	}
// affiche la vue de confirmation de  suppression  d un compte// 
	case 'supprimerCompte':
	{
		include('vues/v_confirmation.php');  
		break;		
	}
// suppression d un compte // 
	case 'confirmationSuppresionCompte':
	{ $id = $_SESSION['id_utilisateur'];
	  @$confirm  = $_REQUEST['confirm'];
	 
		if ( $confirm =="oui")
		{
			$sup = $pdo->supprimerCompte($id);
			if ($sup)
			{
				$message = "votre compte à bien été supprimer";
				include('vues/v_message.php');
				include('vues/v_accueil.php');
			}
			else 
			{
				$message = "non";
				include('vues/v_message.php'); 
			}
		}
		else
		{ 
			include('vues/v_espaceClient.php');
		}	 
		break;	
	}
	case 'activerProduit':
	{
		$id = $_REQUEST['id'];	 
		$onoff = $_REQUEST['onoff'];
		$sup = $pdo->activerProduit($id,$onoff);
		?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=administrer&action=voirToutLesProduits">
		<?php	 
		break;
	}
	case 'trierProduit':
	{
		$action = $_REQUEST['tri'];
		$lesProduits = $pdo->trierProduit($action);
		include('vues/v_produitsAdmin.php');
		break;
	}
	case 'voirCategories':
	{
  		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categoriesAdmin.php");
		include("vues/v_decoration.php");		
  		break;
	}
	case 'voirProduitsCategorie' :
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categoriesAdmin.php");
  		$categorie = $_REQUEST['categorie'];
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produitsAdmin.php");
		break;
	}
	case 'stat' : 
	{
		$lesProduits = $pdo->StatVente();
		include("vues/v_statProduit.php");		 
		break;
	}	
}
?>