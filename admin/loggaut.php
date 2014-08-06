<?php
// Inkluderar config-filen 
require_once('../includes/config.php');

// Loggar ut användaren och omdirigerar till startsidan
$user->logout();
header('Location: loggain.php'); 

?>