<?php

namespace App\WebSocket;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

class MessageHandler implements MessageComponentInterface
{
    protected SplObjectStorage $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage();
    }


    public function onOpen(ConnectionInterface $conn): void
    {
        $this->connections->attach($conn);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $this->connections->detach($conn);
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, MessageInterface $msg): void
    {
        foreach($this->connections as $connection) {
            if($connection === $from) {
                $connection->send("Next");
            }
            $connection->send($msg);
        }
    }
}
