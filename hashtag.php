<?php
if(isset($_GET["tag"])){
  $tag = preg_replace('#[^a-z0-9_]#i', '', $_GET["tag"]);
  // $tag is now sanitized and ready for database queries here
  $fulltag = "#".$tag;
  echo $fulltag;
}
?>