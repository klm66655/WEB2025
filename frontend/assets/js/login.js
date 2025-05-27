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

    // 🚀 LOGIN FUNKCIONALNOST
    const loginSubmitForm = document.querySelector("form.login");

    loginSubmitForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const email = loginSubmitForm.querySelector('input[name="email"]').value;
        const password = loginSubmitForm.querySelector('input[name="password"]').value;

        try {
            const response = await fetch("http://localhost/movie-serie/backend/rest/auth/login", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, password })
            });

            const result = await response.json();

            if (response.ok) {
                // ✅ Sačuvaj token i korisnika
                localStorage.setItem("token", result.data.token);
                localStorage.setItem("user", JSON.stringify(result.data));

                alert("Login uspešan!");
                window.location.href = "/movie-serie/frontend/pages/dashboard.html"; 
            } else {
                alert("Greška: " + result.error);
            }
        } catch (err) {
            console.error("Greška pri loginu:", err);
            alert("Došlo je do greške. Pokušaj ponovo.");
        }
    });
});
