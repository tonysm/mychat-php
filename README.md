# Example of a chat app using just PHP and WebSocket

## Instalation
To start, do as follows:

* point a VirtualHost to public dir
* run <code>composer install</code> 
* run <code>php bin/websocket-server.php</code> to start the websocket server
* open the project in the browser, login in and chat!

## Snippets
### VirtualHost
<code>
    &lt;VirtualHost *:80&gt;
        ServerName mychat.dev
        DocumentRoot /var/www/mychat/public
        &ltDirectory /&gt;
            Options FollowSymLinks
            AllowOverride All
        &lt;/Directory&gt;
        &lt;Directory /var/www/mychat/public&gt;
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
        &lt;/Directory&gt;
    &lt;/VirtualHost&gt;
</code>

## Using
* PHP
* Ratchet (php websocket server)
* Twitter Bootstrap
