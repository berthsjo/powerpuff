<?php
// inkluderar config-filen 
require_once('../includes/config.php');

// kollar om användaren är inloggad, annars skickas man till loggain.php
if(!$user -> is_logged_in()) { header('Location: loggain.php'); }