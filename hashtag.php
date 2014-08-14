<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blogg</title>
    <link rel="stylesheet" href="css/meyerReset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsiv.css">
      <link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>

</head>
<body>

  <div id="wrapper">
    <img class="logindex" src="bilder/puff4.png">
    <div id="wrapperind">

<?php
require 'includes/config.php';

if(isset($_GET['tag'])){
  $tag = $_GET['tag'];

try {

        $stmt = $db->query("SELECT * FROM blog_posts WHERE LOCATE('$tag', postCont)");
        while($row = $stmt->fetch()){

          echo '<div>';
            echo '<h1><a href="se-post.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
            echo '<p>Upplagd '.date('j/N/Y H:i', strtotime($row['postDate'])).'</p>';
            echo '<p>'.$row['postDesc'].'</p>';
            echo '<p><a href="se-post.php?id='.$row['postID'].'">Läs mer</a></p>';
          echo '</div>';
          echo '<br/><br/>';

        }



      } catch(PDOException $e) {
          echo $e->getMessage();
      }

}






// if(isset($_GET["tag"])){
//   $tag = preg_replace('#[^a-z0-9_]#i', '', $_GET["tag"]);
//   // $tag is now sanitized and ready for database queries here
//   $fulltag = "#".$tag;
//   echo $fulltag;
// }
?>

    </div>
</div>

</body>
</html>