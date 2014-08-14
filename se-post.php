<?php require('includes/config.php');

// se-post.php används för att visa inlägg som användaren klickat på.

// Queryn använder prepared statement. Infon som visas väljer man genom en $_GET[id] request som
// skickar ett id.
// Prepared statement funkar bättre än en vanlig query eftersom den förbereder databasen för att
// köra queryn. När vi sedan kör $stmt->execute kommer datan i arryen skickas till databasens server.
// Dessa två kopplas aldrig ihop vilket minimerar risken att någon fular i databasen.

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

// Om det efterfrågade postID't inte existerar i databasen, skickas användaren tillbaka till index-sidan


if($row['postID'] == ''){
  header('Location: ./');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
    <link rel="stylesheet" href="css/meyerReset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsiv.css">
</head>
<body>

    <div id="wrapper">
        <img class="logindex" src="bilder/puff4.png">
        <div id="wrapperind">
        <p><a href="./">Startsidan</a></p>


<?php
function hashtag ($string) {
    // klipp på mellanrummet signalerar ny item i arrayen

    $words = explode(" ", $string);

    // Loopa över alla enskilda ord, och håll i orden som referens (så kan vi skriva över dem!)
    foreach ($words as &$word) {
        # code...
        $testWord = strip_tags($word);
      if (substr($testWord, 0, 1) === '#') { 
          // så att #-markerade ord blir länkar.
        $tag = substr($testWord, 1);
        $word = "<a href='hashtag.php?tag=$tag'>$testWord</a>"; # TODO: Vad ska det,  stå i länkens href??
      }
    }
    return implode(" ", $words);
}
//echo hashtag('Jag ska på fest ikväll #taggad #glad');
?>



    <?php
    // Visar den valda posten.
        echo '<div>';
            echo '<h1>'.$row['postTitle'].'</h1>';
            echo '<p>Upplagd '.date('j/N/Y', strtotime($row['postDate'])).'</p>';
            echo '<br/>';
            echo '<p>'.hashtag($row['postCont']).'</p>';
        echo '</div>';
    ?>

    </div>
</div>

</body>
</html>