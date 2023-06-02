document.addEventListener("DOMContentLoaded", function() {
    var createAccountButton = document.getElementById("lien-ex1");
    var connectionAccountButton = document.getElementById("lien-ex2");
    var signinSection = document.getElementById("connection");
    var title_login = document.getElementById("T1");
    var title_logup = document.getElementById("T2");
    var formlogin = document.getElementById("form");
    var formlogup = document.getElementById("form2");

    createAccountButton.addEventListener("click", function() {
        signinSection.id = "inscription";

        title_login.style.display = "none";
        title_logup.style.display = "flex";

        formlogin.style.display = "none";
        formlogup.style.display = "block";
        
        createAccountButton.style.display = "none";
        connectionAccountButton.style.display = "flex";
    });

    connectionAccountButton.addEventListener("click", function() {
        signinSection.id = "connection";

        title_login.style.display = "flex";
        title_logup.style.display = "none";

        formlogin.style.display = "block";
        formlogup.style.display = "none";

        createAccountButton.style.display = "flex";
        connectionAccountButton.style.display = "none";
    });
}); 