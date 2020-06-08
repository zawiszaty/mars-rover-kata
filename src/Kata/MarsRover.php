<?php

declare(strict_types=1);

namespace Kata;

use Kata\MovePolicy\MovePolicyCollection;
use Kata\Planet\ObstacleEvent;
use Kata\Planet\Planet;

final class MarsRover
{
    private Position $position;
    private MovePolicyCollection $movePolicyCollection;
    private Direction $direction;
    private Planet $planet;
    private array $obstacleEvents;

    public function __construct(Position $position, Direction $direction, Planet $planet)
    {
        $this->position             = $position;
        $this->direction            = $direction;
        $this->planet               = $planet;
        $this->movePolicyCollection = new MovePolicyCollection();
        $this->obstacleEvents       = [];
    }

    public function move(MoveDirection $moveDirection): Move
    {
        $move = $this->movePolicyCollection->find($this->direction)
            ->move($moveDirection, new Move($this->position, $this->direction));
        $move = $this->planet->resetGrid($move);

        if ($this->planet->isFreeField($move->getPosition()))
        {
            $this->position  = $move->getPosition();
            $this->direction = $move->getDirection();

            return $move;
        }
        $this->obstacleEvents[] = new ObstacleEvent($move->getPosition());

        return new Move($this->position, $this->direction);
    }

    public function getObstacleEvents(): array
    {
        return $this->obstacleEvents;
    }
}
