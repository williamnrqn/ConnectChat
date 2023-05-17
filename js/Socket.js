// Établir la connexion WebSocket
var socket = new WebSocket('ws://ConnectChat:8080'); // Remplacez l'URL et le port par ceux de votre serveur WebSocket

// Gérer les événements de la connexion WebSocket
socket.onopen = function(event) {
    console.log("connection done");
};

socket.onmessage = function(event) {
  var message = event.data;
  // Logique pour traiter le message reçu
  var jsonString = JSON.parse(message);
  console.log(jsonString.message);
};

socket.onclose = function(event) {
  // Logique lorsque la connexion est fermée
};

socket.onerror = function(error) {
  // Logique en cas d'erreur
};

// Envoyer un message au serveur WebSocket
function sendMessage(data) {
    let u = window.location.hostname;
    console.log(j);
    let msg = {let, message: u};
    socket.send(JSON.stringify(msg));
}