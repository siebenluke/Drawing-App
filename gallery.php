<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Drawing App Portfolio</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/portfolio.css">
</head>
<body>

<?php include('header.php'); ?>

<h1 class='title'>Gallery</h1>
<?php

try {
    // connect to the database
    $con = new PDO("mysql:host=localhost;dbname=sparklybubbles", "sparklybubbles", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // search the databases to find this user's images
    $selectQuery = "SELECT filePath
                    FROM drawing
                    ORDER BY id DESC";
    $ps = $con->prepare($selectQuery);
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    $bodyContent = "";
    $bodyContent .= "<ul ID=\"imageGallery\">";
    $counter = 0;
    foreach($data as $row) {
        $img = $row['filePath'];
        $bodyContent .= "<li><a href=\"#\"><img class=\"images\" id=\"img$counter\" src=\"$img\" width=\"200\"></a></li>";
        $counter = $counter +1;
    }
    $json = json_encode($data);
    if(strlen($counter) == 0) {
        print "<p>The gallery is empty.</p>";
    }
    else {
        print "<p>This is the gallery.</p>";
        $bodyContent .= "</ul>";
        print $bodyContent;
    }
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
}
?>

<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/gallery.js" type="text/javascript" charset="utf-8"></script>



</body>
</html>


