document.addEventListener("DOMContentLoaded", function() {
    let themeToggle = document.getElementById("theme-toggle");
    let body = document.body;
  
    themeToggle.addEventListener("click", function() {
        body.classList.toggle("light-theme");
    });


    let to_message = document.getElementById("to-message");
    let to_friend = document.getElementById("to-friend");
    let to_group = document.getElementById("to-group");
    let to_setting = document.getElementById("to-setting");

    let core = document.getElementById("core");

    to_message.addEventListener("click", function() {
        to_message.classList = "select";
        to_friend.classList = "no-select";
        to_group.classList = "no-select";
        to_setting.classList = "no-select";

        core.style.display = "";

        document.title =  "Message | ConnectChat";
    });
    
    to_friend.addEventListener("click", function() {
        to_message.classList = "no-select";
        to_friend.classList = "select";
        to_group.classList = "no-select";
        to_setting.classList = "no-select";
        
        core.style.display = "none";

        document.title = "Ami | ConnectChat";
    });

    to_group.addEventListener("click", function() {
        to_message.classList = "no-select";
        to_friend.classList = "no-select";
        to_group.classList = "select";
        to_setting.classList = "no-select";

        core.style.display = "none";

        document.title = "Groupe | ConnectChat";
    });

    to_setting.addEventListener("click", function() {
        to_message.classList = "no-select";
        to_friend.classList = "no-select";
        to_group.classList = "no-select";
        to_setting.classList = "select";

        core.style.display = "none";

        document.title = "Réglage | ConnectChat";
    });
});
