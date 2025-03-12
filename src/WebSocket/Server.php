<?php

namespace App\WebSocket;

use Closure;

class Server
{
    public $server;
    public $events = [];
    public $observers = [];

    public function __construct()
    {
        $this->server = new \Swoole\WebSocket\Server("0.0.0.0", 9501);

        $this->server->on('open', function (\Swoole\WebSocket\Server $server, \Swoole\Http\Request $request) {
            array_push($this->observers, new Observer($request->fd));
        });

        $this->server->on('message', function (\Swoole\WebSocket\Server $server, \Swoole\WebSocket\Frame $frame) {
            $message = Message::fromFrame($frame);
            $this->events[$message->getKey()]($server, $message);
        });
    }

    public function push(Message $message)
    {
        foreach ($this->observers as $observer) {
            $this->server->push($observer->id, (string) $message);
        }
    }

    public function on(string $key, Closure $callback): void
    {
        $this->events[$key] = $callback;
    }

    public function start()
    {
        $this->server->start();
    }
}