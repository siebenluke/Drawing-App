<?php session_start(); ?>
<?php
$_SESSION['loggedIn'] = false;

$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$name = filter_input(INPUT_POST, "name");

$message = "This is where you can create/edit images.";

try {
    // connect to the database
    $con = new PDO("mysql:host=localhost;dbname=sparklybubbles", "sparklybubbles", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // make sure the user entered in data for email/password field
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) == 0) {
        $_SESSION["message"] = "<p class='error'>Email and password fields are required for new and existing users!<p>";
        header("Location: error.php");
        exit();
    }

    // search the database
    $searchQuery = "SELECT *
				    FROM user
					WHERE email = :email";
    $preparedSearch = $con->prepare($searchQuery);
    $preparedSearch->execute(array(':email' => $email));
    $searchData = $preparedSearch->fetchAll(PDO::FETCH_ASSOC);

    // try to find the user's info
    $searchInfo = "";
    foreach($searchData as $row) {
        foreach($row as $header => $value) {
            $searchInfo .= "<p>$header = $value</p>";
        }
    }

    // see if this is a returning user
    if(strlen($searchInfo) <> 0) {
        // get name, hash, userid
        $email = strtolower($email);
        $hashNameQuery = "SELECT name, hash, userid
				          FROM user
						  WHERE email = :email";
        $preparedPasswordNameSearch = $con->prepare($hashNameQuery);
        $preparedPasswordNameSearch->execute(array(':email' => $email));
        $namePasswordData = $preparedPasswordNameSearch->fetchAll(PDO::FETCH_ASSOC);

        $hash = "";
        $userid = "";
        foreach($namePasswordData as $row) {
            $name = $row['name'];
            $hash = $row['hash'];
            $userid = $row['userid'];
        }

        // check the password
        if(password_verify($password, $hash)) {
            $_SESSION["userid"] = $userid;
            $_SESSION["message"] = "<p>$message</p>";
        }
        else {
            $_SESSION["message"] = "<p class='error'>Wrong email and/or password!</p>";
            header("Location: error.php");
            exit();
        }
    }
    else {
        // new users need a name
        if(strlen($name) == 0) {
            $_SESSION["message"] = "<p class='error'>Name is a required field for new users!</p>";
            header("Location: error.php");
            exit();
        }

        // insert new user's info to the database
        $hash = password_hash(filter_input(INPUT_POST, "password"), PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO user(email, hash, name)
						VALUES(:email, :hash, :name)";
        $preparedInsert = $con->prepare($insertQuery);
        $preparedInsert->execute(array(':email' => $email, ':hash' => $hash, ':name' => $name));
        $con->exec($preparedInsert);

        $userid = $con->lastInsertId();

        $_SESSION["userid"] = $userid;
        $_SESSION["message"] = "<p>Thanks for signing up $name! $message</p>";
    }

    $_SESSION["email"] = $email;
    $_SESSION["name"] = $name;
    $_SESSION['loggedIn'] = true;

    header("Location: drawingApp.php");
    exit();
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
}
?>
