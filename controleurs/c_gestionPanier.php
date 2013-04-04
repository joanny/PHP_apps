<?php
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirPanier':
	{
		$n= nbProduitsDuPanier();
		if($n > 0)
		{
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			include("vues/v_panier.php");
			$_SESSION['panier'] = true;
		}
		else
		{
			$message = "panier vide";
			include ("vues/v_message.php");
			$_SESSION['panier'] = false;
		}
		break;
	}
	case 'supprimerUnProduit':
	{
		$idProduit=$_REQUEST['produit'];
		retirerDuPanier($idProduit);
		$desIdProduit = getLesIdProduitsDuPanier();
		$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
?>
			<meta http-equiv="refresh" content="0;url=index.php?uc=gererPanier&action=voirPanier">
<?php
		break;
	}
	case 'confirmerCommande':
	{		 
			$lesproduits = $_SESSION['quantite'];
			$id_utilisateur = $_SESSION['id_utilisateur'];
			//var_dump($lesproduits);
			//echo $id_utilisateur;
		  	$cmd = $pdo->creerCommande($id_utilisateur , $lesproduits);
			$message = "Votre commande à été pris en compte";
			include('vues/v_message.php');
			include('vues/v_espaceClient.php');
	break;
	}
	case 'ajouterAuPanier' :
	{
		$idProduit=$_REQUEST['produit'];
		$categorie = $_REQUEST['categorie'];
		$ok = ajouterAuPanier($idProduit);
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
		if(!$ok)
		{
			$message = "Cet article est déjà dans le panier !!";
			include("vues/v_message.php");					     
		}	 	
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits.php");		
		break;
	}
	case 'voirCommande' :
	{
			@$id_utilisateur = $_SESSION['id_utilisateur'];
			$lesProduits = $pdo->getCommande($id_utilisateur);
			$nb = count($lesProduits);
			$lesProduits = array_reverse($lesProduits);			
			include('vues/v_commande.php');	
			break;
	}
}
?>


