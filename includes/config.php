<?php 
// ob = Output Buffering som är en inbyggd funktion i PHP
// Så länge sen är aktiv skickas ingen data från scriptet (utom till headern). Datan sparar i intern buffert. 

ob_start();
ob_start();
session_start();

// Databas kontakten, uppgifterna
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','db');

$db = new PDO("mysql:host=".DBHOST.";post=8889;dbname="
  .DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::
  ERRMODE_EXCEPTION);

// Tidszonen
date_default_timezone_set('Europe/Stockholm');

// Autoload är för att klasserna ska inkluderas automatiskt. Så slipper man inkludera allt manuellt.
function __autoload($class) {

// strtolower = konverterar namn till små bokstäver (anv. namn) kollar om filen finns och inkluderar den.

  $class = strtolower($class);

    //if call from within assets adjust the path !!! Kolla upp mer
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

  //if call from within admin adjust the path !!! Kolla upp mer
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

  //if call from within admin adjust the path !!! Kolla upp mer
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

}

// Här kollar vi så user finns i databas !!! Kolla upp mer
$user = new User($db);
?>

