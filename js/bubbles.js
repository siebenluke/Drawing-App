/**
 * Start the animation after the entire page has loaded.
 */
var canvasID = "bubblesCanvas";
var backgroundColor = getComputedStyle(document.querySelector('body')).getPropertyValue("background-color");
window.onload = init();

/**
 * Add bubble animation to the back of the page.
 */
function init() {
    document.body.innerHTML += '<canvas id="' + canvasID + '" width="' + screen.width + '" height="' + screen.height + '">' +
                                '<p class="error">Canvas not supported!</p></canvas>';
    document.write('<style>#' + canvasID + ' {    width: 100%;    height: 100%;    position: fixed;    ' +
                    'top: 0px;    left: 0px;    z-index: -1;} }</style>');

    var bubblesAmount = 50;
    var bubbleArr = [];
    for(var i = 0; i < bubblesAmount; i++) {
        bubbleArr.push(new Bubble());
    }

    var delay = 1;
    setInterval(function() { animateBubbles(bubbleArr); }, delay);
}

/**
 * Animate the bubble array.
 * @param bubbleArr the bubble array
 */
function animateBubbles(bubbleArr) {
    clearScreen();

    for(var i = 0; i < bubbleArr.length; i++) {
        drawBubble(bubbleArr[i]);
        bubbleArr[i].moveUp();
    }
}

/**
 * Draws a bubble.
 * @param bubble the bubble
 */
function drawBubble(bubble) {
    var canvas = document.getElementById(canvasID);
    var context = canvas.getContext('2d');

    var startAngle = 0;
    var endAngle = Math.PI * 2;
    var anticlockwise = true;

    context.fillStyle = bubble.color.getFillStyle();
    context.beginPath();
    context.arc(bubble.x, bubble.y, bubble.radius, startAngle, endAngle, anticlockwise);
    context.closePath();
    context.fill();
}

/**
 * Creates a bubble object.
 * @constructor the bubble constructor
 */
function Bubble() {
    // global variables
    var canvas = document.getElementById(canvasID);
    this.width = canvas.width;
    this.height = canvas.height;
    this.minRadius = 25;
    this.maxRadius = 75;
    this.minSpeed = 1;
    this.maxSpeed = 1;
    var color = new Color();

    // temp variables to setup instance variables
    var x = getRandom(this.width);
    var y = getRandom(this.height);
    var radius = getRandomWithMin(this.minRadius, this.maxRadius);
    var speed = getRandomWithMin(this.minSpeed, this.maxSpeed);

    // instance variables
    this.radius = radius;
    this.x = x;
    this.y  = y + this.radius; // make bubble start below the screen
    this.speed = speed;
    this.color = color;

    /**
     * Moves the bubble up.
     */
    this.moveUp = function() {
        this.y -= this.speed;

        this.jumpToBottom();
    };

    /**
     * Moves the bubble under the bottom of the screen, and randomizes the x, radius, speed, and g values.
     */
    this.jumpToBottom = function() {
        // wait until bubble is above the screen
        if(this.y <= (0 - this.radius)) {
            this.y = this.height + this.radius;

            this.x = getRandom(this.width);
            this.radius = getRandomWithMin(this.minRadius, this.maxRadius);
            this.speed = getRandomWithMin(this.minSpeed, this.maxSpeed);
            this.color.randomize();
        }
    }
}

/**
 * Creates a color object.
 * @constructor the color constructor
 */
function Color() {
    // global variables
    this.minC = 0;
    this.maxC = 255;
    this.a = 0.25;

    // temp variables to setup instance variables
    var r = getRandomWithMin(this.minC, this.maxC);
    var g = getRandomWithMin(this.minC, this.maxC);
    var b = getRandomWithMin(this.minC, this.maxC);

    // instance variables
    this.r = r;
    this.g = g;
    this.b = b;

    /**
     * Gets the fill sytle.
     * @returns {string} the fill style
     */
    this.getFillStyle = function() {
        return "rgba(" + this.r + ", " + this.g + ", " + this.b +", " + this.a + ")";
    };

    /**
     * Randomizes the color.
     */
    this.randomize = function() {
        this.r = getRandomWithMin(this.minC, this.maxC);
        this.g = getRandomWithMin(this.minC, this.maxC);
        this.b = getRandomWithMin(this.minC, this.maxC);
    }
}

/**
 * Clears the screen using the body's background color.
 */
function clearScreen() {
    var canvas = document.getElementById(canvasID);
    var context = canvas.getContext('2d');
    var width = canvas.width;
    var height = canvas.height;

    context.fillStyle = backgroundColor;
    context.fillRect(0, 0, width, height);
}

/**
 * Gets a random number between 0 - max.
 * @param max the max
 * @returns {number} the random number
 */
function getRandom(max) {
    return getRandomWithMin(0, max);
}

/**
 * Gets a random number between min - max.
 * @param min the min
 * @param max the max
 * @returns {number} the random number
 */
function getRandomWithMin(min, max) {
    return Math.round((Math.random()  * (max + 1)) + min);
}
