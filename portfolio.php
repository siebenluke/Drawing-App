<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Drawing App Portfolio</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/drawingApp.css">
</head>
<body>

<?php include('header.php'); ?>

<h1 class='title'>Drawing App Portfolio</h1>
<?php
$userid = $_SESSION["userid"];

try {
    // connect to the database
    $con = new PDO("mysql:host=localhost;dbname=sparklybubbles", "sparklybubbles", "sesame");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // search the databases to find this user's images
    $selectQuery = "SELECT filePath
                    FROM drawing
                    WHERE userid = :userid
                    ORDER BY id DESC";
    $ps = $con->prepare($selectQuery);
    $ps->bindParam(':userid', $userid);
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    $bodyContent = "";
    $counter = 0;
    foreach($data as $row) {
        $extra = $counter + 1;
        $bodyContent .= "<h3>Image $extra</h3>";
        $bodyContent .= "<canvas id = \"canvas$counter\" class=\"drawingPortfolio\" width=\"854\" height=\"480\"></canvas>";
        $counter = $counter +1;
    }
    $json = json_encode($data);
    if(strlen($bodyContent) == 0) {
        print "<p>Your portfolio is empty.</p>";
    }
    else {
        print "<p>This is your portfolio.</p>";
        print $bodyContent;
    }
    //`exit();
}
catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
}
?>

<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>


<script type="text/javascript">
   //<![CDATA[
   var imgs = jQuery.parseJSON ( '<?php echo $json; ?>' );
   for(i = 0; i < imgs.length; i++) {
    var canvas = document.getElementById("canvas" + i);
    console.log(canvas);
    console.log(imgs[i].filePath);
    var ctx = canvas.getContext("2d");
    var image = new Image();
    (function(ctx, image) {
        image.onload = function() {
            ctx.drawImage(image, 0, 0);
        }
        image.src = imgs[i].filePath;
    })(ctx, image);
   }

   //]]>
   </script>
</body>
</html>


