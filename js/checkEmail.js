// setup variables
var email = $("#email");
var idArr = ['confirmPassword', 'name'];
var submit = $("#submit");

// call checkEmail on email input field change
email.change(function() {
    checkEmail(email.val());
});

/**
 * AJAX call to see if email exists in database.
 * @param email the email
 */
function checkEmail(email) {
    $.post('checkEmail.php', { "email" : email }, function(data) {
        if(data.foundEmail) {
            hideFields();
            submit.html("Sign In");
        }
        else {
            showFields();
            if(email.length == 0) {
                submit.html("Sign Up/In");
            }
            else {
                submit.html("Sign Up");
            }
        }
    });
}

/**
 * Hides fields.
 */
function hideFields() {
    for(var i = 0; i < idArr.length; i++){
        $("label[for=" + idArr[i] + "], input#" + idArr[i]).hide();
    }
}

/**
 * Shows fields.
 */
function showFields() {
    for(var i = 0; i < idArr.length; i++){
        $("label[for=" + idArr[i] + "], input#" + idArr[i]).show();
    }
}
