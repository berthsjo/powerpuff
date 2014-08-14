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


    <!-- Detta är ett test för hashtag # -->
        <?php
    function convertHashtags($str){
        $regex = "/#+([a-zA-Z0-9_]+)/";
        $str = preg_replace($regex, '<a href="hashtag.php?tag=$1">$0</a>', $str);
        return($str);
    }
    $string = "I am #UberSilly and #MegaPlayful online";
    $string = convertHashtags($string);
    echo $string;
    ?>

    

    <?php
    // Visar den valda posten.
        echo '<div>';
            echo '<h1>'.$row['postTitle'].'</h1>';
            echo '<p>Upplagd '.date('j/N/Y', strtotime($row['postDate'])).'</p>';
            echo '<br/>';
            echo '<p>'.$row['postCont'].'</p>';
        echo '</div>';
    ?>

    </div>
</div>

</body>
</html>