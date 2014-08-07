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
date_default_timezone_set('Europe/Stockholm');
date_default_timezone_set('Europe/Stockholm');

//språk

setlocale(LC_ALL, "sv_SE");

// Autoload är till för att klasserna ska inkluderas automatiskt.
// Slipper inkludera allt manuellt.
function __autoload($class) {

  // strtolower = konverterar namn till små bokstäver (anv. namn) kollar om filen finns och inkluderar den.
  $class = strtolower($class);

    //classpath är en autoload
   $classpath = 'klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }

   $classpath = '../klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }


   $classpath = '../../klasser/klass.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
  }
}

// Skapar användare i databasen
$user = new User($db);
