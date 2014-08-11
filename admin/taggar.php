<?php
require_once('../includes/config.php');
function hashtag($string) {
//variabel kopplad till #
$htag = "#";
// använder explode-funktionen för att konvertera strängen //till en array
//mellanrummet signalerar ny item i arrayen

$arr = explode(" ", $string);
$arrc = count($arr);
$i = 0;

// whileloop söker igenom arryen efter en hashtag
while($i< $arr){

  if (substr($arr[$i], 0, 1) === $htag) {
  // så att #-markerade ord blir länkar
  echo $arr[$i] = "<a href='#'>".$arr[$i]."</a>";

  }

  $i++;
}
//gör arrayen tillbaka till en sträng
$string = implode(" ", $arr);
return $string;
}
echo hashtag;
$>