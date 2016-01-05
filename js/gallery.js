//PROBLEM: USER WHEN CLICKING ON AN IMAGE GOES TO A DEAD END
//SOLUTION: CREATE AN OVERLAY WITH THE LARGE IMAGE - LIGHTBOX


var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
//var $caption = $("<p></p>");
 // ADD AN IMAGE TO AN OVERLAY
$overlay.append($image);
// ADD OVERLAY
$("body").append($overlay); 
  // A CAPTION
//$overlay.append($caption);
// CAPTURE THE CLICK EVEN ON A LINK TO AN IMAGE
$("#imageGallery a").click( function(event) {
  event.preventDefault(); //stops default action of the browser.
  console.log(this);
  var imageLocation = $(this).children("img").attr("src");  
  console.log(imageLocation);
  // SHOW THE OVERLAY
  $overlay.show();
  // UPDATE OVERLAY WITH THE IMAGE LINKED IN THE LINK
  $image.attr("src", imageLocation);
  // GET CHILD'S ALT ATTRIBUTE AND SET CAPTION
  //var captionText = $(this).children("img").attr("alt");
  //$caption.text(captionText);
});
// WHEN OVERLAY IS CLICKED 
$overlay.click(function () {
  // HIDE THE OVERLAY   
  $overlay.hide();
});