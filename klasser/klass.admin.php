//Här kan användaren logga in och logga ut, verifiera password och krypterar även passwordet.

// Funktionen _construct anropas så snart en klass körs, metoden skickar en koppling till databasen som tillhör en
//variabel inom klassen. Detta lilla trix gör att alla metoder får tillgång till databasen.

    private $db;

    public function __construct($db){
    $this->db = $db;
    }



//För att verifiera om användaren är inloggad använder vi metoden is_logged_in()
//Den söker efter sessionen "loggedin" och är den true så är det en användare inloggad annars
//så returnerar den inget.

    public function is_logged_in(){
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    return true;
    }
    }



//För att skapa ett krypterat lösenord när vi lägger till nya admins till bloggen har vi metoden create_hash
//Det finns inbyggd kryptering i funktionen.

      public function create_hash($value)
    {
    return $hash = crypt($value, '$2a$12$'.substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22));
    }


//För att verifiera krypteringen används denna metod:

    private function verify_hash($password,$hash)
    {
    return $hash == crypt($password, $hash);
    }

In order to verify a password matched a password given on login the hashed password needs to be fetched from the database,
the username is passed to the database and the hashed password is returned

//För att verifiera att ett pass









