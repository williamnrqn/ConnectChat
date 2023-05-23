const input = document.getElementById("input-text-message");

input.addEventListener("keypress", function (params) {
    if (params.keyCode == 13) {
        const text = input.value;
        input.value = "";
        sendMessage(text);
    }
});

function sendMessage(data) {
    // let infoMessageTo = document.getElementById();
    socket.send(JSON.stringify({message: {to:"1234", msg: data}}));
    console.log({message: {to:"1234", msg: data}});
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
    if (data.msg) {
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
