document.addEventListener("DOMContentLoaded", function() {
    let list_friend = document.getElementById("list-friend");
    let list_online = document.getElementById("list-online"); 
    let list_attente = document.getElementById("list-attent");
    let list_newFriend = document.getElementById("list-newFriend");

    let down_friend = document.getElementById("down-friend");
    let down_attente = document.getElementById("down-attent");
    let down_newFriend = document.getElementById("down-newFriend");

    list_friend.addEventListener("click", function() {
        list_friend.classList = "select";
        list_online.classList = "no-select";
        list_attente.classList = "no-select";
        list_newFriend.classList = "no-select";

        down_friend.style.display = "";
        down_attente.style.display = "none";
        down_newFriend.style.display = "none";
    });

    list_online.addEventListener("click", function() {
        list_friend.classList = "no-select";
        list_online.classList = "select";
        list_attente.classList = "no-select";
        list_newFriend.classList = "no-select";

        down_friend.style.display = "";
        down_attente.style.display = "none";
        down_newFriend.style.display = "none";
    });

    list_attente.addEventListener("click", function() {
        list_friend.classList = "no-select";
        list_online.classList = "no-select";
        list_attente.classList = "select";
        list_newFriend.classList = "no-select";

        down_friend.style.display = "none";
        down_attente.style.display = "";
        down_newFriend.style.display = "none";
    });

    list_newFriend.addEventListener("click", function() {
        list_friend.classList = "no-select";
        list_online.classList = "no-select";
        list_attente.classList = "no-select";
        list_newFriend.classList = "select";

        down_friend.style.display = "none";
        down_attente.style.display = "none";
        down_newFriend.style.display = "";
    });
});