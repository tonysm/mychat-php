# Example of a chat app using just PHP and WebSocket

## Instalation
To start, do as follows:

* point a VirtualHost to public dir
* run <code>composer install</code> 
* run <code>php bin/websocket-server.php 8888</code> to start the websocket server at the port 8888 (the default port)
* open the project in the browser, login in and chat!

### Warning
if you change the port, you also have to change it in the JS file at public/js/app.js

## Snippets
### VirtualHost
    <VirtualHost *:80>
        ServerName mychat.dev
        DocumentRoot /var/www/mychat/public
        <Directory />
            Options FollowSymLinks
            AllowOverride All
        </Directory>
        <Directory /var/www/mychat/public>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
        </Directory>
    </VirtualHost>

## Using
* PHP
* Ratchet (php websocket server)
* Twitter Bootstrap
