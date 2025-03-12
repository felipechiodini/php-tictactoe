<?php

namespace App\Game;

class Board
{
    public CONST ROWS = 3;
    public CONST COLUNS = 3;

    private $board;

    public function __construct()
    {
        $this->board = array_fill(0, self::ROWS, array_fill(0, self::COLUNS, null));
    }

    public function fillSpace(int $row, int $col, Player $player)
    {
        if ($this->spaceNotEmpty($row, $col)) {
            throw new \Exception('Space is not empty');
        }

        if ($row > self::ROWS || $col > self::COLUNS) {
            throw new \Exception('Invalid position');
        }

        $this->board[$row][$col] = $player;
    }

    public function spaceNotEmpty(int $row, int $col): bool
    {
        return $this->spaceEmpty($row, $col) === false;
    }

    public function spaceEmpty(int $row, int $col): bool
    {
        if ($this->board[$row][$col] === null) {
            return true;
        }

        return false;
    }

    public function checkWin(Player $player): bool
    {
        return $this->checkWinForHorizontal($player)
            || $this->checkWinForVertical($player)
            || $this->checkWinForDiagonal($player);
    }

    private function checkWinForHorizontal(Player $player): bool
    {
        for ($row = 0; $row < self::ROWS; $row++) {
            if ($this->board[$row][0] !== $player) {
                return false;
            }
        }

        return true;
    }

    private function checkWinForVertical(Player $player): bool
    {
        for ($col = 0; $col < self::COLUNS; $col++) {
            if ($this->board[0][$col] !== $player) {
                return false;
            }
        }

        return true;
    }

    private function checkWinForDiagonal(Player $player): bool
    {
        return $this->board[0][0] === $player
            && $this->board[1][1] === $player
            && $this->board[2][2] === $player
            || $this->board[0][2] === $player
            && $this->board[1][1] === $player
            && $this->board[2][0] === $player;
    }
}