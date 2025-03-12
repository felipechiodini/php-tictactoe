<?php

namespace App\Rooms;

class Rooms
{
    public $collection = [];

    public function list(): array
    {
        return $this->collection;
    }

    public function create(): Room
    {
        $room = new Room();
        $this->collection[$room->id] = $room;
        return $room;
    }

    public function getbyId(string $id): Room
    {
        return $this->collection[$id];
    }
}