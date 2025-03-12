<?php

namespace App\Rooms;

class Player
{
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}