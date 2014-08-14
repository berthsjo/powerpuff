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