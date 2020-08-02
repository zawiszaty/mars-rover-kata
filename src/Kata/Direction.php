<?php

declare(strict_types=1);

namespace Kata;

use MyCLabs\Enum\Enum;

/**
 * @method static Direction WEST()
 * @method static Direction EAST()
 * @method static Direction NORTH()
 * @method static Direction SOUTH()
 * @psalm-immutable
 */
final class Direction extends Enum
{
    private const WEST  = 'W';
    private const EAST  = 'E';
    private const NORTH = 'N';
    private const SOUTH = 'S';
}
