<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

    private $clients;

    public function __construnct() {
        $this->clients = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients[] = $conn;

        echo "New Connection";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        foreach($this->clients as $client) {
            if ($client != $from) {
                $client->send($msg);
            }
        }

    }

    public function onClose(ConnectionInterface $conn) {

        echo "Connection closed";

    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo $e->getMessage();
    }
}
