const input = document.getElementById("input-text-message");

input.addEventListener("keypress", function (params) {
    if (params.keyCode == 13) {
        const text = input.value;
        input.value = "";
        sendMessage(text);
    }
});

function setConversation(data) {
    document.getElementById('id_from').textContent = data.ID_from;
    data = data.conversation;
    console.log(data);
    let ul = document.getElementById("message-list");
    ul.innerHTML = "";
    let i = 0;
    data.forEach(element => {
        let li = document.createElement('li');
        li.textContent = element.msg;
        li.id = "message";
        if (element.from == document.getElementById('id').textContent) {
            li.className = "to";
        } else {
            li.className = "from";
        }
        ul.appendChild(li);
        if (i == 0) {
            li.id = "message-first";
        }
        i++;
    });
}

function selectClient(idfrom) {
    let li = document.getElementById(idfrom);
    let ul = document.getElementById("client-list");
    let list = ul.getElementsByTagName("li");
    for (let i = 0; i < list.length; i++) {
        list[i].className = "n";
    }
    li.className = "s";
}

function openMessage(idfrom) {
    selectClient(idfrom);
    let id = document.getElementById('id').textContent;
    let ul = document.getElementById("message-list");
    ul.innerHTML = "";
    socket.send(JSON.stringify({get: "message", id: id, idfrom: idfrom}));
}

function sendMessage(data) {
    socket.send(JSON.stringify({message: {from: document.getElementById('id').textContent, to: document.getElementById('id_from').textContent, msg: data}}));
    let li = document.getElementById("message-first");

    let NewMessage = document.createElement('li');
    NewMessage.textContent = data;
    NewMessage.id = "message-first";
    NewMessage.className = "to";
    
    if (li) {
        li.id = "message";
        li.before(NewMessage);
    } else {
        let ul = document.getElementById("message-list");
        ul.appendChild(NewMessage);
    }
}

function getMessage(data) {
    if (data.msg && data.from == document.getElementById('id_from').textContent) {
        let NewMessage = document.createElement('li');
    
        NewMessage.textContent = data.msg;
        NewMessage.id = "message-first";
        NewMessage.className = "from";

        let li = document.getElementById("message-first");
    
        if (li) {
            li.id = "message";
            li.before(NewMessage);
        } else {
            let ul = document.getElementById("message-list");
            ul.appendChild(NewMessage);
        }
    }
}

function getFriend() {
    socket.send(JSON.stringify({get: "friend", id: document.getElementById('id').textContent}));
}

function setFriend(data) {
    let ul = document.getElementById("friend-list");

    data.forEach(element => {
        let li = document.createElement('li');
        if (element.ID_friend1 == document.getElementById('id').textContent) {
            li.textContent = element.ID_friend2;
            li.id = "client-" + element.ID_friend2;
        } else {
            li.textContent = element.ID_friend1;
            li.id = "client-" + element.ID_friend1;
        }
        li.className = "n";
        ul.appendChild(li);
    });
}
