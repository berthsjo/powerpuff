<?php
// ob = Output Buffering är en inbyggd funktion i PHP
// Så länge den är aktiv skickas ingen data från scriptet (utom till headern). 
// Datan sparas i intern buffert.

ob_start();
ob_start();
session_start();

// Databasens kopplingar
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','dbpower');

$db = new PDO("mysql:host=".DBHOST.";port=8889;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Tidszonen
date_default_timezone_set('Europe/London');
date_default_timezone_set('Europe/London');

// Autoload är till för att klasserna ska inkluderas automatiskt.
// Slipper inkludera allt manuellt.
function __autoload($class) {

  // strtolower = konverterar namn till små bokstäver (anv. namn) kollar om filen finns och inkluderar den.
  $class = strtolower($class);

    //if call from within assets adjust the path !!! Kolla upp mer
   $classpath = 'klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

  //if call from within admin adjust the path !!! Kolla upp mer
   $classpath = '../klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

  //if call from within admin adjust the path !!! Kolla upp mer
   $classpath = '../../klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }
}

// Här kollar vi så user finns i databas !!! Kolla upp mer
$user = new User($db);
