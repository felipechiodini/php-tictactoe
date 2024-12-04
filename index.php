<?php

use Swoole\Websocket\Server;

$server = new Server($host, $port);

$server->on('start', function (Server $server) use ($hostname, $port) {
    echo sprintf('Swoole HTTP server is started at http://%s:%s' . PHP_EOL, $hostname, $port);
});
