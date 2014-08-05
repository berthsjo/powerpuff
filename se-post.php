

//viewpost.php används för att visa inlägg som användaren klickat på.

//Queryn använder något som heter prepared statement. Infon som visas väljer man genom en $_GET[id] request som
//skickar ett id.
//Prepared statement funkar bättre än en vanlig query eftersom den förbereder databasen för att
//köra queryn. När vi sedan kör $stmt->execute kommer datan i arryen skickas till databasens server.
//Dessa två connectar aldrig vilket minimerar risken att någon fular i databasen.

    $stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['id']));
    $row = $stmt->fetch();

//Om det efterfrågade postID't inte existerar i databasen, skicka användaren tillbaka till index-sidan


    if($row['postID'] == ''){
    header('Location: ./');
    exit;
    }

//Visa hela den valda posten.

    echo '<div>';
    echo '<h1>'.$row['postTitle'].'</h1>';
    echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
    echo '<p>'.$row['postCont'].'</p>';
    echo '</div>';

 //Detta är enklast möjliga, förhoppningsvis är det enkelt att lägga till fler features.
