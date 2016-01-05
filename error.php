<?php session_start(); ?>

<?php
if(!isset($_SESSION['message'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Drawing App</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('header.php'); ?>
<?php
$message = $_SESSION["message"];
print $message;
?>

</body>
</html>