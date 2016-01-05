<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Drawing App Sign Up/In</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php session_destroy(); ?>
<?php include('header.php'); ?>

<h1 class="title">Drawing App Sign Up/In</h1>
<form action="signin.php" method="post">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" placeholder="Required" title="Enter your email" />
    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="Required" title="Enter your password" />
    <label for="confirmPassword">Confirm Password</label>
    <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Optional for new users" title="Confirm your password" />
    <p class="hidden warning">Please confirm your password if you're a new user</p>
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Required for new users"  title="Enter your name" />
    <div>
        <button id="submit" type="submit">Sign Up/In</button>
    </div>
</form>

</body>

<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/checkEmail.js" type="text/javascript" charset="utf-8"></script>
<script src="js/passwordsMatch.js" type="text/javascript" charset="utf-8"></script>

</html>
