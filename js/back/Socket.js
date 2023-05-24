let socket = new WebSocket('ws://ConnectChat:8080');

socket.onopen = function(event) {
    socket.send(JSON.stringify({infoUser: {id: "1234"}}));
    console.log("connection...");
    console.log(JSON.stringify({infoUser: {id: "1234"}}));
};

socket.onmessage = function(event) {
    let message = event.data;
    let data = JSON.parse(message);

    if (data) {
        checkTypeInput(data);
    } else console.log("Erreur JSON");
};

socket.onclose = function(event) {}

socket.onerror = function(error) {}

function checkTypeInput(data) {
    if (data.connection) console.log(data.connection.etat);
    if (data.message) getMessage(data.message);
};
