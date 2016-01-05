//PROBLEM: USER INTERACTION CAUSES NO CHANGES TO THE APPLICATION
//SOLUTION: WHEN USER INTERACTS CAUSE CHANGES APPROPRIATELY

var color = $(".selected").css("background-color");
var $canvas = $(".drawingCanvas");
var context = $canvas[0].getContext("2d");
var lastEvent;
var mouseDown = false;
var didOnce = false;

//WHEN CLICKING ON CONTROL LIST ITEMS
$(".controls").on("click", "li", function(){
    //DESELECT SIBLING ELEMENTS
    $(this).siblings().removeClass("selected");
    //SELECT CLICKED ELEMENT
    $(this).addClass("selected");
    //CACHE CURRENT COLOR
    color = $(this).css("background-color");
});

//WHEN ADD COLOR IS PRESSED
$("#revealColorSelect").click( function(){
    //SHOW COLOR SELECT OR HIDE THE COLOR SELECT
    changeColor();
    $("#colorSelect").toggle();
});

//UPDATE THE NEW COLOR SPAN
function changeColor() {
    var r = $("#red").val();
    var g = $("#green").val();
    var b = $("#blue").val();
    $("#newColor").css("background-color", "rgb(" + r + "," + g + "," + b +")");
}
//WHEN COLOR SLIDERS CHANGE
//$("input[type=range]").change(changeColor);
$('input[type=range]').on('input', function(){
    changeColor();
});

//WHEN "ADD COLOR" IS PRESSED
$("#addNewColor").click(function(){
    //APPEND THE COLOR TO THE CONTROLS UL
    var $newColor = $("<li></li>");
    $newColor.css("background-color", $("#newColor").css("background-color"));
    $(".controls ul").append($newColor);
    //SELECT THE NEW COLOR
    $newColor.click();
});

//ON MOUSE EVENTS ON THE CANVAS
$canvas.mousedown(function(e){
    lastEvent = e;
    mouseDown = true;
    didOnce = false;
}).mousemove(function(e) {
    //DRAW LINES
    //document.getElementsByTagName("canvas")[0];  THIS LINE AND THIS LINE $("canvas")[0]; ARE EQUIVALENT.
    if(mouseDown) {
        context.beginPath();
        context.moveTo(lastEvent.offsetX, lastEvent.offsetY);
        context.lineTo(e.offsetX, e.offsetY);
        context.strokeStyle = color;
        context.stroke();
        lastEvent = e;   
    }
}).mouseup(function(e) {
    mouseDown = false;
    if(!didOnce){
        captureDrawing();
        didOnce = true;
    }
}).mouseleave(function(){
    $canvas.mouseup();
});