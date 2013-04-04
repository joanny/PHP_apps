<?php
 
class PdoMystick
{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=my_stick';   		
      	private static $user='sk' ;    		
      	private static $mdp='EW8ah9tyWFqEt6X5' ;	
		private static $monPdo;
		private static $monPdoMystick = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoMystick::$monPdo = new PDO(PdoMystick::$serveur.';'.PdoMystick::$bdd, PdoMystick::$user, PdoMystick::$mdp); 
			PdoMystick::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoMystick::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdoMystick = PdoMystick::getPdoMystick();
 * @return l'unique objet de la classe PdoMystick
 */
	public  static function getPdoMystick()
	{
		if(PdoMystick::$monPdoMystick == null)
		{
			PdoMystick::$monPdoMystick= new PdoMystick();
		}
		return PdoMystick::$monPdoMystick;  
	}
/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return le tableau associatif des catégories 
*/
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoMystick::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau associatif  
*/
	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="select * from produit INNER JOIN categorie ON produit.id_type_tel = categorie.id_type_tel where produit.id_type_tel = '$idCategorie' AND visible ='oui'";
		$res = PdoMystick::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param $desIdProduit tableau d'idProduits
 * @return un tableau associatif 
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produit where id_produit = '$unIdProduit'";
				$res = PdoMystick::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
 
// fonction permettant de creer une commande //
	public function creerCommande($id_utilisateur, $lesproduits )
	{	
		$req = "select max(num_commande) as maxi from commande";
		$res = PdoMystick::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		$date = date('Y/m/d');
		$req = "insert into commande values ('$idCommande','$date','$id_utilisateur')";
		$res = PdoMystick::$monPdo->exec($req);
		foreach(@$lesproduits as $cle=>$valeur)
		{
			$req = "insert into contenir values ('$idCommande','$cle','$valeur')";
			$res = PdoMystick::$monPdo->exec($req);
		}
		supprimerPanier();
	}
// fonction permettant d'obtenir les commandes de l utilisateur //
	public function getCommande($id_utilisateur)
	{
		$req = "SELECT  produit.id_produit, nom, description, prix, image_produit, quantite , date , contenir.num_commande
				FROM commande
				INNER JOIN contenir ON commande.num_commande = contenir.num_commande
				INNER JOIN produit ON produit.id_produit = contenir.id_produit
				WHERE id_utilisateur = '$id_utilisateur'
				 ";
		$res = PdoMystick::$monPdo->query($req);
		$produit = $res->fetchAll();
		return $produit;
	}
	//connection administrateur
	public function connection($nom,$mdp)
	{
		$req = "select nom_utilisateur ,mot_de_passe  from administrateur where 
		nom_utilisateur ='$nom' AND mot_de_passe = '$mdp'";
		$res = PdoMystick::$monPdo->query($req);
		$ladmin = $res->fetchAll();
		if ($ladmin){
			enregAdmin();
			if (utilisateurConnecte() == true )
			{
				session_unset();
			}
			estConnecter();			   			
			$_SESSION['admin'] = true ;
			$_SESSION['nom'] = $nom;	
			return true;
		}
		else
		{
			return false;
		}
	}
// deconnection de l utilisateur courant //
	public function deconnection()
	{
		session_unset();
		return true;
	}
// retourne le produit ( utiliser pour obtenir la vue "v_details.php" et dans le cas controlleur "details") //
	public function getLeProduit($id)
	{
		$req = "SELECT * FROM produit WHERE id_produit = '$id' AND visible ='oui'";
		$res = PdoMystick::$monPdo->query($req);
		$leProduit = $res->fetchAll();
		return $leProduit;
	}
// rechercher un produit selon la saisi ( la requete ne conserne que le nom ou la description ) //
	public function rechercheProduit($saisi)
	{
		$req = "SELECT * FROM produit WHERE visible = 'oui' AND (description like '%$saisi%' or nom like '%$saisi%') ";		
		$res = PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();		 
		return $lesProduits;		 		  	 			
	}
// connexion utilisateur (cas" connexion_utilisateur" ) //	
// le nom recuperer correpond au mail 
	public function connexionUtilisateur( $nom ,$mdp )
	{
		$req = "SELECT * FROM utilisateur WHERE adresse_electronique = '$nom' AND mot_de_passe = '$mdp' AND  activer = 'oui'";
		$res = PdoMystick::$monPdo->query($req); 
		$utilisateur = $res->fetchAll();
	
		@$panier = $_SESSION['panier'];
		if ($utilisateur)
		{     
			enregUtilisateur();
			
			if (adminConnecte())
			{ 
				session_unset();
			}
			
			$_SESSION['utilisateur'] = true;
			$utilisateur = $utilisateur[0] ;
			recupInfo($utilisateur); 
			return true;		
		}
		else
		{
			return false;
		}
			$_SESSION['panier'] = $panier;
	}
// modifier un produit  (cas "modifier_produit")  // 
	public function modifierProduit( $id , $nom , $description ,$prix , $categorie )
	{
		$req ="UPDATE  produit  SET  nom='$nom' , description  = '$description'  ,  prix = '$prix' ,
		id_type_tel='$categorie' WHERE id_produit = '$id'"; 
 		$res = PdoMystick::$monPdo->exec($req);
		//var_dump($_REQUEST);
		$modif = false ;		
		if ($res)
		{  
			$modif = true ;
			
		}
		return $modif;
	}
// incription d'un utilisateur  (cas "incription" )//
	public function inscrireUtilisateur( $nom , $prenom , $rue , $ville , $code_postale , $pays , $date_naissance , $adresse_electronique , $mot_de_passe , $newsletter , $activer)
	{
	  $req ="INSERT INTO utilisateur(id_utilisateur , nom_utilisateur , prenom , rue , ville , code_postale , pays , date_naissance , adresse_electronique  , mot_de_passe , newsletter , activer )
	         VALUES ('' , '$nom' , '$prenom' , '$rue' , '$ville' , '$code_postale' , '$pays' , '$date_naissance' , '$adresse_electronique', '$mot_de_passe' ,'$newsletter' , '$activer')";
	  $res = PdoMystick::$monPdo->exec($req);		
	  $inscription = false;
	  
	  if ($res)
	  {
		$inscription = true;
	  }
		return $inscription ;
	}
 
//  obtenir les informations d'un utilisateur ( cas " verification_information" c_gestionPanier.php" )
	public function getUtilisateur($id)
	{
	  $req ="SELECT * FROM utilisateur WHERE id_utilisateur = '$id'";
	  $res =  PdoMystick::$monPdo->query($req);
	  $utilisateur = $res->fetchAll();
	  return $utilisateur;
	}
// modifier les infos d un utilisateur cas "modifierInscriptionUtilisateur"  c_gestionProduit.php )//  
	public function updateUtilisateur ($id , $rue , $ville , $code_postale , $pays   , $adresse_electronique , $mot_de_passe,$newsletter  )				 				
	{ 
	  $req ="UPDATE utilisateur SET rue = '$rue' , ville = '$ville' ,code_postale = '$code_postale' ,pays = '$pays' ,
	  adresse_electronique = '$adresse_electronique', mot_de_passe = '$mot_de_passe' , newsletter = '$newsletter' 
	  WHERE id_utilisateur = '$id'";
	  $res = PdoMystick::$monPdo->exec($req);			
		 
		  if ($res)
		  {		  			  
			$updateUtilisateur = true;
		  }		   
			return @$updateUtilisateur;
	}

	public function ajoutProduit($nom , $description , $image , $prix , $categorie )
	{	     
		$id_couleur = 0;
	    $req ="INSERT INTO produit VALUES ('','$nom','$description','$image','$prix','$id_couleur','$categorie','oui')";
		$res = PdoMystick::$monPdo->exec($req);		
		$ajout = false;
	  	  if ($res)
		  {
			$ajout = true;
		  }
			return $ajout ;
	} 
	public function supprimerProduit( $id )
	{
	   $req ="SELECT count(*) as nb FROM contenir WHERE id_produit ='$id'";
	   $res = PdoMystick::$monPdo->query($req);
	   $nbproduit = $res->fetch();
	   $sup = false;
	   if ($nbproduit['nb'] == 0)
	   {
		    $req = "UPDATE produit  SET   visible  = 'non' WHERE id_produit ='$id' ";			 
			$res = PdoMystick::$monPdo->exec($req);					
			  if ($res)
			  {
				$sup = true;
			  }
		}		  
			  return $sup ;
	} 
    public function supprimerCompte( $id )
	{
	   $req = "DELETE FROM utilisateur WHERE id_utilisateur ='$id' ";
	 	$res = PdoMystick::$monPdo->exec($req);		
		$sup = false;
	  	  if ($res)
		  {
			$sup = true;
			session_unset();
		  }
	      return $sup ;
	} 
	public function verifDoublons( $nom , $prenom , $rue , $ville , $code_postale , $pays , $date_naissance , $adresse_electronique , $mot_de_passe)
	{
	   $req ="SELECT *   FROM utilisateur WHERE nom_utilisateur ='$nom'
	   AND prenom ='$prenom' 
	   AND rue = '$rue' AND ville = '$ville' 
	   AND code_postale = '$code_postale'
	   AND pays ='$pays' 
	   AND date_naissance = '$date_naissance' 
	   AND adresse_electronique = '$adresse_electronique'
	   AND mot_de_passe ='$mot_de_passe'";
	   
	   $req1 ="SELECT count(*) as nb FROM utilisateur WHERE adresse_electronique = '$adresse_electronique'";
	   
	   $DoublonsAdresseMail = PdoMystick::$monPdo->query($req1);
	   $res = PdoMystick::$monPdo->query($req);
	   
	   $nbAdr = $DoublonsAdresseMail->fetch();
	   $util = $res->fetchAll();
	   
	   $verif = false;
	   
	   if ($nbAdr['nb'] == 0)
	   {
		   if  (!$util) 
		   {
			$verif =true; 
		   }
		} 
	   return $verif; 	   	   	   	   	   
	}
	public function newsletter($mail)
	{	 
	   	   $req ="SELECT adresse_mail FROM  newsletter WHERE adresse_mail = '$mail'";
		   $res = PdoMystick::$monPdo->query($req);
		   $util = $res->fetchAll();
	 	    if ($util)
			{			
				  $message = "votre adresse mail a déjà enregistré(e)";
			}
			else
			{				
				   $req1 ="INSERT INTO newsletter VALUES ('', '$mail')";
				   $res1 = PdoMystick::$monPdo->exec($req1);    				   			
				   $message = "vous êtes enregistré(e)";
			}	
			return $message ;
	}
	public function getLesUtilisateurs()
	{
		$req = "SELECT * FROM utilisateur";
		$res = PdoMystick::$monPdo->query($req); 
		$utilisateurs = $res->fetchAll();		
		return $utilisateurs;
	}

	public function DroiUtilsateur($id , $onoff)
	{	 
	  $req ="UPDATE utilisateur SET  activer = '$onoff' WHERE  id_utilisateur = '$id'";
	  $res = PdoMystick::$monPdo->exec($req); 	  		
	  return true;
	}
	public function RechercheUtilisateur($info)
	{
		$req = "SELECT * FROM utilisateur WHERE  nom_utilisateur like '%$info%'  OR  prenom like '%$info%'";
		$res = PdoMystick::$monPdo->query($req);
		$utilisateur = $res->fetchall();
		return $utilisateur;			
	}
	public function getLesCommandes()
	{
		$req = "SELECT * FROM commande  INNER JOIN contenir ON commande.num_commande = contenir.num_commande GROUP BY commande.num_commande";
		$res = PdoMystick::$monPdo->query($req);
		$lesCommandes = $res->fetchAll();
		return $lesCommandes;
	}
	public function getDetailsCommandes($num_commande)
	{
		$req = "SELECT * FROM contenir  INNER JOIN produit  ON contenir.id_produit = produit.id_produit  INNER JOIN commande ON commande.num_commande = contenir.num_commande WHERE commande.num_commande ='$num_commande' ";
		$res = PdoMystick::$monPdo->query($req);
		$lesDetails = $res->fetchAll();
		return $lesDetails;
	}
	public function  getProduits()
	{
		$req = "SELECT * FROM produit INNER JOIN categorie ON produit.id_type_tel = categorie.id_type_tel";
		$res = PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();
		return $lesProduits;
	}
	public function activerProduit($id, $onoff)
	{
			$req = "UPDATE produit  SET   visible  = '$onoff' WHERE id_produit ='$id' ";			 
			$res = PdoMystick::$monPdo->exec($req);
	}
	public function  trierProduit($critere)
	{
		$req = "SELECT * FROM produit as p INNER JOIN categorie as c ON p.id_type_tel = c.id_type_tel ORDER BY $critere";
		$res = PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();
		return $lesProduits;
	}
	public function rechercherProduitAdmin($saisi)
	{
		$req= "SELECT * FROM produit as p INNER JOIN categorie as c ON p.id_type_tel = c.id_type_tel WHERE nom LIKE '%$saisi%' or description LIKE '%$saisi% '";
		$res= PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();
		return $lesProduits;
	}
	public function trierPrix()
	{ 
	    $req= "SELECT * FROM produit ORDER BY (prix)";
		$res= PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();
		return $lesProduits;
	}
	 
	// Nb de ventes par produit
	// SELECT c.id_produit, SUM( quantite ) AS nbVente
	// FROM contenir AS c
	// JOIN produit AS p ON c.id_produit = p.id_produit
	// GROUP BY c.id_produitNb de ventes par produit  
    public function StatVente()
	{ 
	    $req= "SELECT c.id_produit, image_produit , prix, SUM( quantite ) AS nbVente FROM contenir AS c JOIN produit AS p ON c.id_produit = p.id_produit   GROUP BY  c.id_produit, image_produit , prix";
		$res= PdoMystick::$monPdo->query($req);
		$lesProduits = $res->fetchAll();
		return $lesProduits;
	}
     
}
?>