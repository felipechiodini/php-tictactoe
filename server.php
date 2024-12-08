<?php

require_once __DIR__ . '/vendor/autoload.php';

$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);

$game = new App\Game();

$server->on('open', function (Swoole\WebSocket\Server $server, Swoole\Http\Request $request) use ($game) {
    echo "server: handshake success with fd{$request->fd}\n";

    if ($game->hasPlayerCircle()) {
        $game->setPlayerTimes($request->fd);
        $server->push($request->fd, json_encode([
            'method' => 'start',
            'message' => 'You are player Times'
        ]));
    } else {
        $game->setPlayerCircle($request->fd);
        $server->push($request->fd, json_encode([
            'method' => 'start',
            'message' => 'You are player Circle'
        ]));
    }
});

$server->on('message', function (Swoole\WebSocket\Server $server, Swoole\WebSocket\Frame $frame) use ($game) {
    $data = json_decode($frame->data);

    if ($data->method === 'fill') {
        $game->fillSpace($frame->fd, $data->data->x, $data->data->y);
    }

    foreach ($server->connections as $connection) {
        $server->push($connection, json_encode([
            'method' => 'render',
            'data' => [
                'x' => $data->data->x,
                'y' => $data->data->y,
                'player' => $frame->fd
            ]
        ]));
    }
});

$server->on('close', function ($server, $fd) use ($game) {
    $game->removePlayer($fd);
});

$server->start();
