<?php
/**
 * Check if email exists in database.
 * @param $email the email
 * @return bool true if the email exists in the database
 */
function checkEmail($email) {
    // make sure the user entered a valid email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    try {
        // connect to the database
        $con = new PDO("mysql:host=localhost;dbname=sparklybubbles", "sparklybubbles", "sesame");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        return strlen($searchInfo) <> 0;
    }
    catch (PDOException $ex) {
        echo 'ERROR: ' . $ex->getMessage();
    }

    return false;
}

// setup variables
$email = filter_input(INPUT_POST, "email");
$foundEmail = checkEmail($email);

// return data in json format
header('Content-Type: application/json');
echo json_encode(array("foundEmail" => $foundEmail));
?>