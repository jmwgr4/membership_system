document.addEventListener("DOMContentLoaded", function() {
    const loginContainer = document.querySelector(".login-container");
    const signupContainer = document.querySelector(".signup-container");

    document.getElementById("showSignup").addEventListener("click", function() {
        loginContainer.style.display = "none";
        signupContainer.style.display = "block";
    });

    document.getElementById("showLogin").addEventListener("click", function() {
        signupContainer.style.display = "none";
        loginContainer.style.display = "block";
    });

    document.getElementById("signupForm").addEventListener("submit", function(event){
        event.preventDefault();

        let firstName = document.getElementById("firstName").value;
        let middleName = document.getElementById("middleName").value || "";
        let lastName = document.getElementById("lastName").value;
        let schoolId = document.getElementById("schoolId").value;
        let username = document.getElementById("signupUsername").value;
        let password = document.getElementById("signupPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        let phone = document.getElementById("phone").value;
        let role = document.getElementById("role").value;

        if(password !== confirmPassword) {
            alert("Passwords do not match!");
            return;
        }

        if(role !== "member"  && role !== "officer") {
            alert("Invalid role selection!");
            return;
        }

        fetch("register.php", {
            method: "POST", 
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ firstName, middleName, lastName, schoolId, username, password, phone, role })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if(data.success) {
                loginContainer.style.display = "block";
                signupContainer.style.display = "none";
            }
        })
    })
})