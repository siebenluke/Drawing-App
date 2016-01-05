<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Drawing App</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/drawingApp.css">
</head>
<body>

<?php include('header.php'); ?>

<h1 class='title'>Drawing App</h1>
<?php
$message = $_SESSION["message"];
print $message;
?>

<!-- Drawing App -->
<canvas	class="drawingCanvas" width="854" height="480"></canvas>
<div>
    <button onclick="saveDrawing()"> Save Drawing </button>
    <button onclick="redisplayDrawing()"> Redraw Drawing </button>
    <button onclick="clearDrawing()"> Clear Drawing </button>
    <button onclick="drawPreviousImage()"> Undo </button>
    <button onclick="drawNextImage()"> Redo </button>
</div>
<div class="controls">
    <ul class="colors">
        <li class="red selected"></li>
        <li class="blue"></li>
        <li class="yellow"></li>
    </ul>
    <button id="addNewColor">Add Color</button>
    <div id="colorSelect">
        <span id="newColor"></span>
        <div class="sliders">
            <p>
                <label for="red">Red</label>
                <input id="red" name="red" type="range" min=0 max=255 value=0>
            </p>
            <p>
                <label for="green">Green</label>
                <input id="green" name="green" type="range" min=0 max=255 value=0>
            </p>
            <p>
                <label for="blue">Blue</label>
                <input id="blue" name="blue" type="range" min=0 max=255 value=0>
            </p>
        </div>
    </div>
</div>

</body>

<script src="js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/drawingApp.js" type="text/javascript" charset="utf-8"></script>
<script src="js/screenCapture.js" type="text/javascript" charset="utf-8"></script>

</html>
