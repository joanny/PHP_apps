<?php
if(mail("joannysimpore@gmail.com", "Le sujet : message depuis mon formulaire", $message, $headers)) {
header("location: formulaire.php?error=0");
exit;
}
else {
header("location: formulaire.php?error=1");
exit;
} 
?>