<?php
$dossier ='image_test'; $marque = $dossier ; $nom ="haut"; $genre = "masculin";$nb_prod= 19;
 $description ="ouverains incontestés du pixel art, le collectif eBoy a développé au fil des ans des œuvres sophistiquées où l'on peut voir des robots déchaînés escaladant de grands immeubles à côté de jeunes filles bronzées en bikini, tout ça dans un monde 3D complexe et ludique. Avec leur style incroyable, Steffen Sauerteig, Svend Smital et kai Vermehr ont rapideme...";
 
$dirname = "./$dossier/"; 
$dir = opendir($dirname); 
$i = 0;
 
while($file = readdir($dir)) { 
 
 if($file != '.' && $file != '..' && !is_dir($dirname.$file)) 
	{  
		$dirname = str_replace('.','',$dirname);
		$tab[$i] = $dirname.''.$file;
	
	 $i++;
	} 
}

closedir($dir); 
 
 // tab_column = ['id','type','marque','nom','lien','genre']
 /*
 $cnx = mysql_connect("localhost", "root","");
 $db = mysql_select_db("my_stick");
 $id =0;

  $i = 2;
$a=2;

  while ($a <= $nb_prod){
   $lien[$a] = "image_test/'$nom[$i]'"; echo $nom[$i];
    $a ++;
$i ++;
  }   
$i = 2;
$min =5;
$max = 50;	
while ( $i <  $nb_prod ){

$tab[$i] = str_replace('./','/',$tab[$i]);
$tab[$i] = str_replace('//','/',$tab[$i]);
$n = $lien[$i];
echo $n.'<br>';
$prix = rand( $min , $max );
 $sql = "INSERT INTO produit (id_produit,nom,description,image_produit,prix ,id_couleur ,id_type_tel ) VALUES ( '','$nom[$i]',' $description','$n','$prix',0,5)";
 
$requete = mysql_query($sql,$cnx) or die (mysql_error() );  $i ++;
 }   */
 				

?> 