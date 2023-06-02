

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

    let core = document.getElementById("core-message");
    let core_f = document.getElementById("core-friend");
    let core_g = document.getElementById("core-group");
    let core_s = document.getElementById("core-seting");

    to_message.addEventListener("click", function() {
        to_message.classList = "select-img";
        to_friend.classList = "no-select-img";
        to_group.classList = "no-select-img";
        to_setting.classList = "no-select-img";

        core.style.display = "";
        core_f.style.display = "none";
        core_g.style.display = "none";
        core_s.style.display = "none";

        document.title =  "Message | ConnectChat";
        getFriend();
    });
    
    to_friend.addEventListener("click", function() {
        to_message.classList = "no-select-img";
        to_friend.classList = "select-img";
        to_group.classList = "no-select-img";
        to_setting.classList = "no-select-img";
        
        core.style.display = "none";
        core_f.style.display = "";
        core_g.style.display = "none";
        core_s.style.display = "none";

        document.title = "Ami | ConnectChat";
    });

    to_group.addEventListener("click", function() {
        to_message.classList = "no-select-img";
        to_friend.classList = "no-select-img";
        to_group.classList = "select-img";
        to_setting.classList = "no-select-img";

        core.style.display = "none";
        core_f.style.display = "none";
        core_g.style.display = "";
        core_s.style.display = "none";

        document.title = "Groupe | ConnectChat";
    });

    to_setting.addEventListener("click", function() {
        to_message.classList = "no-select-img";
        to_friend.classList = "no-select-img";
        to_group.classList = "no-select-img";
        to_setting.classList = "select-img";

        core.style.display = "none";
        core_f.style.display = "none";
        core_g.style.display = "none";
        core_s.style.display = "";

        document.title = "Réglage | ConnectChat";
    });
});
