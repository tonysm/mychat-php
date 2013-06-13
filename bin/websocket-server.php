<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MyApp\WebsocketServer\Chat;

$server = IoServer::factory(new WsServer(new Chat()), 8888);

$server->run();
