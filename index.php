


<?php require('includes/config.php'); ?>


//Indexfilen listar alla poster från post-tabellen i databasen.
//En query körs för att välja kolummner genom postID från från tabellen blog_post och
//fortsätter sedan hämta i nummerordning. Inläggen loopas igenom och vid varje loop visas
//titel, beskrivning, datum och en länk till hela inlägget.



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

  <div id="wrapper">

    <h1>Blog</h1>
    <hr />

    <?php
    //Queryn för att visa inlägg ligger i ett try/catch-statement så att PDOExeption kan visa om det
    //blir några errors.

    //inläggets id skickas vidare till nästa sida i en sk query-string.
    //?id blir till en variabel som anger värdet i URLen.
      try {

        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
        while($row = $stmt->fetch()){

          echo '<div>';
            echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
            echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
            echo '<p>'.$row['postDesc'].'</p>';
            echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
          echo '</div>';

        }

      } catch(PDOException $e) {
          echo $e->getMessage();
      }
    ?>

  </div>


</body>
</html>