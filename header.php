<?php
$signedInHeader = "<header>
<div>
    <button onclick='location.href=\"drawingApp.php\"'>Drawing App</button>
    <button onclick='location.href=\"portfolio.php\"'>Portfolio</button>
    <button onclick='location.href=\"gallery.php\"'>Gallery</button>
    <button onclick='location.href=\"about.php\"'>About</button>
    <button onclick='location.href=\"signout.php\"'>Sign Out</button>
</div>
</header>";
$signedOutHeader = "<header>
<div>
    <button onclick='location.href=\"index.php\"'>Sign Up/In</button>
    <button onclick='location.href=\"gallery.php\"'>Gallery</button>
    <button onclick='location.href=\"about.php\"'>About</button>
</div>
</header>";

//$requestURI = $_SERVER['REQUEST_URI'];

// check if the user is logged in
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    print $signedInHeader;
}
else {
    print $signedOutHeader;

    $requestURI = $_SERVER['REQUEST_URI'];

    // only logged in users can see the drawingApp, and portfolio pages
    if(strpos($requestURI, 'drawingApp.php') || strpos($requestURI, 'portfolio.php')) {
        print "<p class='error'>Sign up/in to see this page.</p>";
        exit();
    }
}
?>

<script src="js/bubbles.js" type="text/javascript" charset="utf-8"></script>
