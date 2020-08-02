<?php

declare(strict_types=1);

namespace Kata;

use MyCLabs\Enum\Enum;

/**
 * @method static MoveDirection FORWARD()
 * @method static MoveDirection BACKWARD()
 * @method static MoveDirection LEFT()
 * @method static MoveDirection RIGHT()
 * @psalm-immutable
 */
final class MoveDirection extends Enum
{
    private const FORWARD  = 'F';
    private const BACKWARD = 'B';
    private const LEFT     = 'L';
    private const RIGHT    = 'R';
}
