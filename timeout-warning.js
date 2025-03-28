/*in milliseconds, 14 mins and 15 mins, respectively*/
let timeoutWarning = 840000; 
let timeoutLogout = 900000;

let warningTimer, logoutTimer;

function resetTimers(){
    clearTimeout(warningTimer);
    clearTimeout(logoutTimer);

    warningTimer = setTimeout(function (){
        alert("Your session will expire in 1 minute.");
    }, timeoutWarning);

    logoutTimer = setTimeout(function (){
        window.location.href = "logout.php";
    }, timeoutLogout);
}

resetTimers();

document.addEventListener("mousemove", resetTimers);
document.addEventListener("keypress", resetTimers);
