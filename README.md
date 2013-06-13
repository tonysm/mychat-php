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
<br/>    ServerName mychat.dev
<br/>    DocumentRoot /var/www/mychat/public
<br/>    &ltDirectory /&gt;
<br/>        Options FollowSymLinks
<br/>        AllowOverride All
<br/>    &lt;/Directory&gt;
<br/>    &lt;Directory /var/www/mychat/public&gt;
<br/>        Options Indexes FollowSymLinks MultiViews
<br/>        AllowOverride All
<br/>        Order allow,deny
<br/>        allow from all
<br/>    &lt;/Directory&gt;
&lt;/VirtualHost&gt;
</code>

## Using
* PHP
* Ratchet (php websocket server)
* Twitter Bootstrap
