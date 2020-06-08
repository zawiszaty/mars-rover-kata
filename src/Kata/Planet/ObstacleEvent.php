<?php

declare(strict_types=1);

namespace Kata\Planet;

use Kata\Position;

final class ObstacleEvent
{
    private Position $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }
}
