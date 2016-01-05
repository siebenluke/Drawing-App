<?php session_start(); ?>
<?php

$filePath = $_POST['imgBase64'];
$userid =  $_SESSION["userid"];
try {
    // Connect to the database.
    $con = new PDO("mysql:host=localhost;dbname=sparklybubbles", "sparklybubbles", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print $filePath."\n";
    // Prepared statement query.
    $query = "INSERT into drawing(userid, filePath) ".
             "values(:userid, :filePath)";

    $ps = $con->prepare($query);
    $ps->execute(array(':userid' => $userid, ':filePath' => $filePath ));

}
catch(PDOException $ex) {
    print 'ERROR: '.$ex->getMessage();
}
catch(Exception $ex) {
    print 'ERROR: '.$ex->getMessage();
}
?>
