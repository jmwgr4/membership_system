function sendResetLink() {
    const email = document.getElementById("email").ariaValueMax;
    if(!email) {
        alert("Please enter your school email.");
        return;
    }
    fetch("reset-password.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: email }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => console.error("Error:", error));
}

function openEmail() {
    window.location.href = "mailto:";
}

function resetPassword() {
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get("token");
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if(password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    fetch("update-password.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token: token, password: password }),
    })
    .then(response => response.json())
    .then(data => {
        if(data.sucess) {
            window.location.href = "password-reset-sucess.html";
        } else {
            alert(data.message);
        }
    })
    .catch (error => console.error("Error:", error));
}