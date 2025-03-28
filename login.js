document.addEventListener("DOMContentLoaded", function() {
    let loginForm = document.getElementById("loginForm");
    const errorMessageElem = document.getElementById("error-message");

    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();

            errorMessageElem.textContent = "";
            errorMessageElem.style.display = "none";
            
            let username = document.getElementById("loginUsername").value;
            let password = document.getElementById("loginPassword").value;

            fetch("http://localhost/System%20Project/login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ username, password })
            })
            .then(response => response.text())
            .then(data => {
                console.log("Raw response:", data);
                try {
                    let jsonData = JSON.parse(data);
                if (jsonData.success) {
                    window.location.href = jsonData.redirect;
                } else {
                    errorMessageElem.textContent = jsonData.message;
                    errorMessageElem.style.display = "block";
                }
            }
            catch(error) {
                console.error("JSON Parsing Error:", data);
            }
            
        })
            .catch(error => console.error("Fetch Error:", error));
        }); 
    } else {
        console.error("Error: loginForm not found in the document.");
    }
});
