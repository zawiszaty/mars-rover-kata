<?php

declare(strict_types=1);

namespace Kata\MovePolicy;

use Kata\Direction;
use Kata\Move;
use Kata\MoveDirection;

final class MoveSouthPolicy implements MovePolicy
{
    public function supports(Direction $direction): bool
    {
        return $direction->equals(Direction::SOUTH());
    }

    public function move(MoveDirection $moveDirection, Move $move): Move
    {
        if ($moveDirection->equals(MoveDirection::FORWARD()))
        {
            return $move->withY($move->getPosition()->getY() - 1);
        }

        if ($moveDirection->equals(MoveDirection::BACKWARD()))
        {
            return $move->withY($move->getPosition()->getY() + 1);
        }

        if ($moveDirection->equals(MoveDirection::RIGHT()))
        {
            $move = $move->withX($move->getPosition()->getX() - 1);

            return $move->withDirection(Direction::WEST());
        }

        if ($moveDirection->equals(MoveDirection::LEFT()))
        {
            $move = $move->withX($move->getPosition()->getX() + 1);

            return $move->withDirection(Direction::EAST());
        }

        throw new \Exception('Invalid move');
    }
}
