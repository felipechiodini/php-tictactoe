<?php

namespace App\Game;

class Player
{
    public $id;
    public $option;

    public function __construct(string $id, OptionInterface $option)
    {
        $this->id = $id;
        $this->option = $option;
    }

    public function isCircle()
    {
        return $this->option instanceof Circle;
    }

    public function isTimes()
    {
        return $this->option instanceof Times;
    }

    public function __toString()
    {
        if ($this->option instanceof Times) {
            return 'X';
        } else if ($this->option instanceof Circle) {
            return 'O';
        }
    }
}