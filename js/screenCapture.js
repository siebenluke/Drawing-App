/**
 * Created by dmitridimov on 11/2/15.
 */
var saveCanvasData = [];
var counter = -1;
var canvas = $(".drawingCanvas")[0];
var mcontext = canvas.getContext("2d");

function captureDrawing() {
    // save canvas image as data url (png format by default)
     saveCanvasData.push({pic:new Image(), imageData:mcontext.getImageData(0, 0, canvas.width, canvas.height)});
     counter++;
     saveCanvasData[counter].pic.src = canvas.toDataURL("image/png");
}

function saveDrawing(){
    var dataUrl = canvas.toDataURL("image/png");
    $.ajax({
      type: "POST",
      url: "saveImage.php",
      data: { 
          imgBase64: dataUrl
        }
      });
}

function redisplayDrawing(){
  if(counter === -1){
    counter = 0;
  }
  if(counter > -1 && counter < saveCanvasData.length){
    context.drawImage(saveCanvasData[counter].pic,0,0); //Gets last drawing
  }
}

function clearDrawing(){
    mcontext.clearRect(0, 0, canvas.width, canvas.height);
}

function drawPreviousImage(){
    if(counter > -1){
      if(counter > -1){
          counter--;
        }
        mcontext.clearRect(0, 0, canvas.width, canvas.height);
        mcontext.drawImage(saveCanvasData[counter].pic,0,0);
    }
    else {
      mcontext.clearRect(0, 0, canvas.width, canvas.height);
      mcontext.save();
    }
}


function drawNextImage(){
  if(counter < saveCanvasData.length){
    if(counter === -1 || counter + 1 < saveCanvasData.length)
    {
      counter++;
    }
    mcontext.drawImage(saveCanvasData[counter].pic,0,0);
	}
}