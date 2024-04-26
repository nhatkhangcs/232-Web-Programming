function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var error = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        error.classList.remove("d-none");
        return false;
    } else {
        error.classList.add("d-none");
        return true;
    }
}