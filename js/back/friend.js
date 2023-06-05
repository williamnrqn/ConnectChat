function searchFriend(params) {
    socket.send(JSON.stringify({search: "newfriend", content: {id: document.getElementById('id').textContent, search: params}}));
}

function my_toLowerCase(string) {
    let result = "";
    for (let i = 0; i < string.length; i++) {
        if (string[i] >= 'A' && string[i] <= 'Z') {
            result += String.fromCharCode(string.charCodeAt(i) + 32);
        } else {
            result += string[i];
        }
    }
    return result;
}

let input_search_friend = document.getElementById("search-newFriend");

input_search_friend.addEventListener("keypress", function (params) {
    if (params.keyCode == 13) {
        const text = input_search_friend.value;
        input_search_friend.value = "";
        searchFriend(text);
    }
});

let search_friend = document.getElementById("search-friend");

search_friend.addEventListener("keyup", function (params) {
    let text = search_friend.value;
    text = my_toLowerCase(text);
    let ul = document.getElementById("client-list-friend");
    for (let i = 0; i < ul.children.length; i++) {
        let li = ul.children[i];
        let name = li.children[1].textContent;
        name = my_toLowerCase(name);
        if (name.indexOf(text) == -1) {
            li.classList.add("hidden");
        } else {
            li.classList.remove("hidden");
        }
    }
});
