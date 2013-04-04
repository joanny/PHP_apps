<div id="message">
	 
		 
<?php 		if ($message == "panier vide")
			{
?> 				</div><div id="vue"><a onClick="history.back()" ><img src="images/panier_vide.gif" width="300px" height="150px"></a></div>
<?php
			}
			else
			{
				if (!(isset($messge)))
				{
 				   echo $message ; 
				}
			}
?>					 
</div>