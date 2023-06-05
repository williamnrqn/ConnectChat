# ConnectChat

## Description

This is a chat application that allows users to create accounts, login, and chat with other users. Users can also create groups and invite other users to join them. Users can also send private messages to other users. The application is built using the Ratchet PHP library for WebSockets.

## Features

- Create accounts
- Login
- Chat with other users
- Create groups
- Invite other users to join groups
- Send private messages to other users

## Technologies

- PHP
- MySQL
- Ratchet PHP library for WebSockets
- HTML
- CSS
- JavaScript

## Requirements

- Composer

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

MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Contact
- [LinkedIn](https://www.linkedin.com/in/william-niarquin/)
- [Email](mailto:william.niarquin@epitech.eu)
