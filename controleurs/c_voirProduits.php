<?php
initPanier();
$action = $_REQUEST['action'];
switch($action)
{
	case 'voirCategories':
	{
  		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
		include("vues/v_decoration.php");		
  		break;
	}
	case 'voirProduits' :
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories.php");
  		$categorie = $_REQUEST['categorie'];
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		$nombreProduits = count($lesProduits);		 
		include("vues/v_produits.php");
		break;
	}
	case 'rechercherProduit':
	{		
	    $saisi = $_REQUEST['recherche'];			
	    $lesProduits = $pdo->rechercheProduit($saisi);
		$nombreProduits = count($lesProduits);
			if ( $saisi != "")
			{
				if ($nombreProduits > 0)
				{   					
					$message = "Resultat de votre recherche pour :<u>$saisi</u> ";
					include('vues/v_message.php');
					include('vues/v_produits.php');
				}
				else
				{ 
					$message = "aucun produit pour <u>$saisi</u>" ;
					$lesCategories = $pdo->getLesCategories();										
					include('vues/v_categories.php');
					include('vues/v_message.php');
					include('vues/v_decoration.php');	 
				}
			}
			else
			{
					$lesProduits = $pdo->getProduits();					 
					include('vues/v_produits.php');
			}
		break;	
	}
	case 'details':
	{
		  $id = $_REQUEST['numProd'];
		  $leProduit = $pdo->getLeProduit($id);
		  include('vues/v_details.php');
		  include('vues/v_caracteristique.php');
		  break;
	}
	case 'trierProduit':
	{
        // $lesProduits = $pdo->trierPrix();
		 // include('vues/v_produits.php');
		  break;
	}
	
	
}
?>

