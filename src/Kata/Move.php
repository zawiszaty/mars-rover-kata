<?php

declare(strict_types=1);

namespace Kata;

final class Move
{
    private Position $position;
    private Direction $direction;

    public function __construct(Position $position, Direction $direction)
    {
        $this->position  = $position;
        $this->direction = $direction;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function withX(int $x): self
    {
        $move           = $this;
        $move->position = new Position($x, $this->position->getY());

        return $move;
    }

    public function withY(int $y): self
    {
        $move           = $this;
        $move->position = new Position($this->position->getX(), $y);

        return $move;
    }

    public function withDirection(Direction $direction): self
    {
        $move            = $this;
        $move->direction = $direction;

        return $move;
    }
}
