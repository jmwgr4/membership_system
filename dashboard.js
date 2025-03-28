document.getElementById("logout-btn").addEventListener("click", function(){
    fetch("logout.php", {method: "POST"})
    .then(response => response.json())
    .then(data => {
        if (data.success){
            window.location.href = "index.html";
        } else {
            console.error("Logout failed: ", data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});
