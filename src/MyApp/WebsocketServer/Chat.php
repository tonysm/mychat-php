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
                $from->user->cod = md5(time() . $msg->user->username);
                $this->clients->attach($from);
                $this->sendUpdateUsersBut($from);
                $this->updateFullUserList($from);
                break;
            default:
                $numRecv = count($this->clients) - 1;
                foreach($this->clients as $client) {
                    if ($this->isDiferentSocketButSameDepartment($from, $client)) {
                        $this->sendMessage($client,  $from->user->username . ': '. $msg->msg);
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
            'username' => $socket->user->username,
            'msg' => $msg,
            'tipo' => 'mainmessage'
        );

        $socket->send(json_encode($data));
    }

    protected function sendUpdateUsersBut($socketNot) {
        $data = array(
            'total' => count($this->clients) - 1,
            'username' => $socketNot->user->username,
            'cod' => $socketNot->user->cod,
            'tipo' => 'userconnected'
        );

        foreach($this->clients as $client) {
            if ($this->isDiferentSocketButSameDepartment($socketNot, $client)) {
                $client->send(json_encode($data));
            }
        }
    }

    protected function updateFullUserList($socket) {
        $users = array();

        foreach($this->clients as $client) {
            if ($this->isDiferentSocketButSameDepartment($socket, $client)) {
                $users[] = array(
                    'username' => $client->user->username,
                    'cod' => $client->user->cod
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
        $msg = array(
            'tipo' => 'userdisconneted',
            'username' => $socket->user->username,
            'cod' => $socket->user->cod
        );

        foreach($this->clients as $client) {
            if ($this->isDifferentDepartment($socket, $client)) {
                $client->send(json_encode($msg));
                $this->updateFullUserList($client);
            }
        }
    }

    protected function isDifferentSocket($first, $second) {
        return $first->user->cod !== $second->user->cod;
    }

    protected function isDifferentDepartment($first, $second) {
        return $first->user->department === $second->user->department;
    }

    protected function isDiferentSocketButSameDepartment($first, $second) {
        return $this->isDifferentSocket($first, $second) && $this->isDifferentDepartment($first, $second);
    }
}
