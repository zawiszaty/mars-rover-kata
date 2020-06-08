<?php

declare(strict_types=1);

namespace Kata\MovePolicy;

use Kata\Direction;
use RuntimeException;

final class MovePolicyCollection
{
    /**
     * @var MovePolicy[]
     */
    private array $policies;

    public function __construct()
    {
        $this->policies = [
            new MoveWestPolicy(),
            new MoveEastPolicy(),
            new MoveNorthPolicy(),
            new MoveSouthPolicy(),
        ];
    }

    public function find(Direction $direction): MovePolicy
    {
        foreach ($this->policies as $policy)
        {
            if ($policy->supports($direction))
            {
                return $policy;
            }
        }

        throw new RuntimeException('Move policy not found');
    }
}
