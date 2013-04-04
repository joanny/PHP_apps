<?php
/**
 * Initialise le panier
 *
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
*/
function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime la variable de type session 
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
*/
// fonction permettant d'ajouter un produit au panier  //
function ajouterAuPanier($idProduit)
{
	
	$ok = true;
 	if(in_array($idProduit,$_SESSION['produits']))
	{ 
		$ok = false;
 	} 
 	else
	{	
		$_SESSION['produits'][]= $idProduit;
	} 
	return $ok;
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 * @return : le tableau
*/
// fonction permettant d'obtenir les produits contenu dans le panier  //
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];
}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
*/
// fonction permettant de compter les produits contenu ds le panier //
function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits']))
	{
	$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un de produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de produit
 
*/
// fonction permettant de retirer un produit du panier //
function retirerDuPanier($idProduit)
{
		$index =array_search($idProduit,$_SESSION['produits']);
		unset($_SESSION['produits'][$index]);
}
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
// fonction permettant de verifer si la valeur saisi est du format d'un code postale postale francais //
function estUnCp($codePostal)
{  
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/
// fonction permettant de verifier si la valeur saisi est un nombre entier //
function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param $mail : la chaîne testée
 * @return : vrai ou faux
*/
// verification de l'email //
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param $nom : chaîne
 * @param $rue : chaîne
 * @param $ville : chaîne
 * @param $cp : chaîne
 * @param $mail : chaîne 
 * @return : un tableau de chaînes d'erreurs
*/
// fonction permettant de controller le infos saisis ds le formulaire d'incription //
function getErreursSaisieCommande($nom,$rue,$ville,$cp,$mail,$mdp,$mdp2)
{
	$v = 0;
	$lesErreurs = array();
	if($nom=="")
	{   $v = 1;
		$lesErreurs[]="Il faut saisir le nom";
	}
	if($rue=="")
	{
	 $v = 1;
	$lesErreurs[]="Il faut saisir la rue";
	}
	if($ville=="")
	{$v = 1;
		$lesErreurs[]="Il faut saisir la ville";
	}
	if  (($mdp != $mdp2) || (($mdp == "" ) || ($mdp2 == "")))
	{	$v = 1;
		$lesErreurs[] ="les mots de passes ne sont pas identiques";
	}
	if($cp=="")
	{$v = 1;
		$lesErreurs[]="Il faut saisir le champ Code postal";
	}
	else
	{
		if(!estUnCp($cp))
		{	$v = 1;
			$lesErreurs[]= "erreur de code postal";
		}
	}
	if($mail=="")
	{$v = 1;
		$lesErreurs[]="Il faut saisir le  mail";
	}
	else
	{
		if(!estUnMail($mail))
		{$v = 1;
			$lesErreurs[]= "erreur de mail";
		}
	} 
	if ($v == 1)
	{
		return $lesErreurs;
	}
	else
	{
		return false;
	}
}
// fonction permettant valider l action de  connexion de l'administrateur //
function enregAdmin()
{
   $_SESSION['admin'] = true;
}
// fonction permettant valider  l action de  connexion de utilisateur //
function enregUtilisateur()
{
   $_SESSION['utilisateur'] = true;
}
// fonction permettant de verifier si l'administrateur est connecter //
function estConnecter()
{
     @$_SESSION['admin'] == true ;
}
// fonction verifier si l utilisateur est connecter //
function utilisateurConnecte()
{   $a =  false ;
    if ( @$_SESSION['utilisateur'] == true )
	{
		$a = true ;
	}
	return $a;
}
function adminConnecte()
{   $a =  false ;
    if ( @$_SESSION['admin'] == true )
	{
		$a = true ;
	}
	return $a;
}
// fonction permettant de recuperer les infos de l utilisateur lors de sa connexion //
function recupInfo($utilisateur)
{
    @$_SESSION['id_utilisateur']=$utilisateur[0] ;
    @$_SESSION['nom_utilisateur']=$utilisateur[1] ;
	@$_SESSION['prenom'] = $utilisateur[2];
	@$_SESSION['rue'] = $utilisateur[3];
	@$_SESSION['ville'] = $utilisateur[4];
	@$_SESSION['code_postale'] = $utilisateur[5];
	@$_SESSION['pays'] = $utilisateur[6];
	@$_SESSION['date_naissance'] = $utilisateur[7];
	@$_SESSION['adresse_electronique'] = $utilisateur[8];	 
	@$_SESSION['mdp'] = $utilisateur[9];	 
	//var_dump($_SESSION);
}
// fonction de convertion en date  format (aaaa-mm-jj)// 
function convertDate ( $jour , $mois , $annee )
{  
  $laDate =  date("$annee/$mois/$jour");  
  return $laDate;
}
// convertion de la date au format "le JJ mois AA
 function dateEnChaine($ladate)
 {
	$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"); 
	$lemois = $ladate[5].$ladate[6];
	if ( $lemois < 10)
	{
		$lemois = $lemois[1];
	}
 
	 
	 $lemois = $mois[$lemois];
	  

	$dateAretourner = "Le $ladate[8]$ladate[9] $lemois $ladate[0]$ladate[1]$ladate[2]$ladate[3]";
	return $dateAretourner;
}
 
 
?>
