<?php

use App\WebSocket\Message;

require_once __DIR__ . '/vendor/autoload.php';

$server = new App\WebSocket\Server();

$rooms = new \App\Rooms\Rooms();

$server->on('create-room', function() use($rooms, $server) {
    $room = $rooms->create();

    $server->push(new Message('room-created', [
        'id' => $room->id
    ]));
});

$server->on('enter', function(\Swoole\WebSocket\Server $server, \App\WebSocket\Message $message) use($rooms) {
    $rooms->getbyId($message->id)
        ->enter();
});

$server->start();