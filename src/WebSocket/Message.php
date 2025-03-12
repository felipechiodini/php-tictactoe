<?php

namespace App\WebSocket;

use JsonSerializable;
use Stringable;

class Message implements Stringable, JsonSerializable
{
    protected $key;
    protected $data;

    public function __construct(string $key, array $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    public static function fromFrame(\Swoole\WebSocket\Frame $frame): self
    {
        $data = json_decode($frame->data);
        return new self($data->method, (array) $data->data);
    }

    public function getKey(): string 
    {
        return $this->key;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __toString(): string
    {
        return $this->jsonSerialize();
    }
   
    public function jsonSerialize(): string
    {
        return json_encode([
            'key' => $this->key,
            'data' => $this->data
        ]);
    }
}