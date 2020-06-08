<?php

declare(strict_types=1);

namespace Kata\MovePolicy;

use Kata\Direction;
use Kata\Move;
use Kata\MoveDirection;

interface MovePolicy
{
    public function supports(Direction $direction): bool;

    public function move(MoveDirection $moveDirection, Move $move): Move;
}
