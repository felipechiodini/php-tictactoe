<?php

namespace App;

class Player
{
    private $option;

    public function __construct(OptionInterface $option)
    {
        $this->option = $option;
    }

    public function __toString()
    {
        return get_class($this->option);
    }
}