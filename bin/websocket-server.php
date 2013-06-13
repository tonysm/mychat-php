<?php
// user can pass the port when starting the server
$port = $argc == 2 ? $argv[1] : 8888;
echo $port;
require dirname(__DIR__) . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MyApp\WebsocketServer\Chat;

$server = IoServer::factory(new WsServer(new Chat()), $port);

$server->run();
