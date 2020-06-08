<?php

declare(strict_types=1);

namespace Kata\MovePolicy;

use Kata\Direction;
use Kata\Move;
use Kata\MoveDirection;

final class MoveWestPolicy implements MovePolicy
{
    public function supports(Direction $direction): bool
    {
        return $direction->equals(Direction::WEST());
    }

    public function move(MoveDirection $moveDirection, Move $move): Move
    {
        if ($moveDirection->equals(MoveDirection::FORWARD()))
        {
            return $move->withX($move->getPosition()->getX() - 1);
        }

        if ($moveDirection->equals(MoveDirection::BACKWARD()))
        {
            return $move->withX($move->getPosition()->getX() + 1);
        }

        if ($moveDirection->equals(MoveDirection::RIGHT()))
        {
            $move = $move->withDirection(Direction::NORTH());

            return $move->withY($move->getPosition()->getY() + 1);
        }

        if ($moveDirection->equals(MoveDirection::LEFT()))
        {
            $move = $move->withDirection(Direction::SOUTH());

            return $move->withY($move->getPosition()->getY() - 1);
        }

        throw new \Exception('Invalid move');
    }
}
