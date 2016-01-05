<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Sign Out</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
session_destroy();
$_SESSION['loggedIn'] = false;
?>
<?php include('header.php'); ?>

<p class="success">You've been signed out.</p>
</body>

</html>
