document.addEventListener("DOMContentLoaded", function() {
    var themeToggle = document.getElementById("theme-toggle");
    var body = document.body;
  
    themeToggle.addEventListener("click", function() {
        body.classList.toggle("light-theme");
    });


    var to_message = document.getElementById("to-message");
    var to_friend = document.getElementById("to-friend");
    var to_group = document.getElementById("to-group");
    var to_setting = document.getElementById("to-setting");

    var core = document.getElementById("core");

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
