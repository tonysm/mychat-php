# Chat app using just PHP and WebSocket

## Instalation
To start, do as follows:

* give execution permition to the bin websocket server, like so: <code>$ chmod +x ./bin/websocketserver</code>
* run <code>$ composer install</code> 
* run <code>$ bin/websocketserver 8888</code> to start the websocket server at the port 8888 (the default port)
* run <code>$ php -S localhost:8000 -t ./public</code> to start a webserver in PHP at port 8000
* open the project in the browser using the url you configured (http://localhost:8000/) and login in the chat

Note: to test the interaction, use a different tab in the browser and login with a different username :)

### Warning
if you change the port, you also have to change it in the JS file at public/js/app.js

## Using
* PHP
* Ratchet (php websocket server)
* Twitter Bootstrap
