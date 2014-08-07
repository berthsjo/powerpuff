<?php
require 'includes/config.php';

//Indexfilen listar alla poster från post-tabellen i databasen.
//En query körs för att välja kolummner genom postID från från tabellen blog_post och
//fortsätter sedan hämta i nummerordning. Inläggen loopas igenom och vid varje loop visas
//titel, beskrivning, datum och en länk till hela inlägget.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blogg</title>
    <link rel="stylesheet" href="css/meyerReset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div id="wrapper">
    <img class="logindex" src="bilder/puff4.png">
    <div id="wrapperind">


    <?php
    //Queryn för att visa inlägg ligger i ett try/catch-statement så att PDOExeption visar eventuella
    // errors.
    //Varje inläggs ID skickas vidare till nästa sida med en sk query-string.

      try {

        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
        while($row = $stmt->fetch()){

          echo '<div>';
            echo '<h1><a href="se-post.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
            echo '<p>Upplagd '.date('j M Y H:i', strtotime($row['postDate'])).'</p>';
            echo '<p>'.$row['postDesc'].'</p>';
            echo '<p><a href="se-post.php?id='.$row['postID'].'">Läs mer</a></p>';
          echo '</div>';

        }



      } catch(PDOException $e) {
          echo $e->getMessage();
      }
    ?>

  </div>
  </div>


</body>
</html>