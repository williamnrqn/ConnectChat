let input_search_friend = document.getElementById("search-newFriend");

input_search_friend.addEventListener("keypress", function (params) {
    if (params.keyCode == 13) {
        const text = input_search_friend.value;
        input_search_friend.value = "";
        searchFriend(text);
    }
});

function searchFriend(params) {
    socket.send(JSON.stringify({search: "newfriend", content: {id: document.getElementById('id').textContent, search: params}}));
}
