document.addEventListener("DOMContentLoaded", function () {
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const signupForm = document.querySelector("form.signup");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector(".signup-link a");

    // Prikaz SignUp forme
    signupBtn.onclick = function () {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
        document.querySelector(".title-text .signup").style.display = "block";
        document.querySelector(".title-text .login").style.display = "none";
    };

    // Prikaz Login forme
    loginBtn.onclick = function () {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
        document.querySelector(".title-text .signup").style.display = "none";
        document.querySelector(".title-text .login").style.display = "block";
    };

    // Klik na "Signup now" link -> prebaci na Signup formu
    signupLink.onclick = function () {
        signupBtn.click();
        return false;
    };


    
    });