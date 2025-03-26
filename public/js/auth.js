// icon password
const passwordField = document.getElementById("password");
const passwordIcon = document.querySelector(".password-icon i");

passwordIcon.addEventListener("click", function () {
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordIcon.classList.remove("fa-eye-slash");
        passwordIcon.classList.add("fa-eye");
        passwordIcon.style.color = "#b17457";
    } else {
        passwordField.type = "password";
        passwordIcon.classList.remove("fa-eye");
        passwordIcon.classList.add("fa-eye-slash");
        passwordIcon.style.color = "#6b7280";
    }
});

// hapus history dan cache
document.addEventListener("DOMContentLoaded", function () {
    history.replaceState(null, null, location.href);
    window.onunload = function () {
        localStorage.clear();
        sessionStorage.clear();
    };
});
