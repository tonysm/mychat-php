<?php

namespace MyApp\WebsocketServer;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn) {
        // do nothing
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg = json_decode($msg);

        switch ($msg->tipo) {
            case 'userconnecting':
                $from->user = $msg->user;
                $this->clients->attach($from);
                $this->sendUpdateUsersBut($from);
                break;
            default:
                $numRecv = count($this->clients) - 1;
                foreach($this->clients as $client) {
                    if ($client !== $from 
                        && $client->user->department === $from->user->department) 
                    {
                        $this->sendMessage($client, $from->user->username . ": " . $msg->msg);
                    }
                }
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $this->sendUserDisconnected($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    protected function sendMessage($socket, $msg) {
        $data = array(
            'username' => 'lorem',
            'msg' => $msg,
            'tipo' => 'mainmessage'
        );

        $socket->send(json_encode($data));
    }

    protected function sendUpdateUsersBut($socketNot) {
        $data = array(
            'total' => count($this->clients) - 1,
            'username' => $socketNot->user->username,
            'tipo' => 'userconnected'
        );

        foreach($this->clients as $client) {
            if ($client !== $socketNot && $socketNot->user->department === $client->user->department) {
                $client->send(json_encode($data));
            }
        }

        $this->updateFullUserList($socketNot);
    }

    protected function updateFullUserList($socket) {
        $users = array();

        foreach($this->clients as $client) {
            if ($client !== $socket && $socket->user->department === $client->user->department) {
                $users[] = array(
                    'username' => $client->user->username
                );
            }
        }

        $data = array(
            'tipo' => 'inituserslist',
            'users' => $users,
            'total' => count($users)
        );

        $socket->send(json_encode($data));
    }

    protected function sendUserDisconnected($socket) {
        echo "user disconnected";
    }
}
