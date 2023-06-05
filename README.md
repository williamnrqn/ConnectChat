# ConnectChat
## Description
This is a chat application that allows users to create accounts, login, and chat with other users. Users can also create groups and invite other users to join them. Users can also send private messages to other users. The application is built using the Ratchet PHP library for WebSockets.

## Installation
1. Clone the repository
2. Run `composer install`

## Usage
1. Run `php server/websocket-server.php` to start the WebSocket server
2. Create one VirtualHost 'connectchat'
3. Add SQL database 'DBConnectChat.sql' to your database server (MySQL) and configure the database connection in 'server/Database.php' / 'server/Messages.php' / 'sever/login.php' / 'server/logup.php'
4. Create an account and login
5. Chat with other users
6. Create groups and invite other users to join them
7. Send private messages to other users

## License
MIT License

## Contributing
1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

## Credits
- [Ratchet](http://socketo.me/) - PHP WebSockets

## Contact
- [LinkedIn](https://www.linkedin.com/in/william-niarquin/)
- [Email](mailto:william.niarquin@epitech.eu)
