var $password = $("#password");
var $confirmPassword = $("#confirmPassword");

function arePasswordsMatching() {
    return $password.val() === $confirmPassword.val();
}

function confirmPasswordEvent() {
    if(arePasswordsMatching() || $confirmPassword.is(":hidden")) {
        $confirmPassword.next().hide();
    }
    else {
        $confirmPassword.next().show();
    }
}

$password.keyup(confirmPasswordEvent);
$confirmPassword.keyup(confirmPasswordEvent);
  