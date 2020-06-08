<?php

declare(strict_types=1);

namespace Kata\Planet;

use Kata\Move;
use Kata\Position;

final class Planet
{
    /**
     * @var array<Field>
     */
    private array $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function isFreeField(Position $position): bool
    {
        return isset($this->fields[$position->getY()][$position->getX()]) && false === $this->fields[$position->getY()][$position->getX()] instanceof Obstacle;
    }

    public function resetGrid(Move $move): Move
    {
        $lastYIndex  = $this->getLastYIndex();
        $firstYIndex = $this->getFirstYIndex();

        if ($move->getPosition()->getY() > $lastYIndex)
        {
            $move = $move->withY($firstYIndex);
        }

        if ($move->getPosition()->getY() < $firstYIndex)
        {
            $move = $move->withY($lastYIndex);
        }
        $lastXIndex  = $this->getLastXIndex();
        $firstXIndex = $this->getFirstXIndex();

        if ($move->getPosition()->getX() > $lastXIndex)
        {
            $move = $move->withX($firstXIndex);
        }

        if ($move->getPosition()->getX() < $firstXIndex)
        {
            $move = $move->withX($lastXIndex);
        }

        return $move;
    }

    private function getLastYIndex(): int
    {
        $count = \count($this->fields);
        $i     = 1;

        foreach ($this->fields as $index => $field)
        {
            if ($i === $count)
            {
                return $index;
            }

            $i++;
        }
    }

    private function getFirstYIndex(): int
    {
        foreach ($this->fields as $index => $field)
        {
            return $index;
        }
    }

    private function getLastXIndex(): int
    {
        $count = \count($this->fields[0]);
        $i     = 1;

        foreach ($this->fields[0] as $index => $field)
        {
            if ($i === $count)
            {
                return $index;
            }

            $i++;
        }
    }

    private function getFirstXIndex(): int
    {
        foreach ($this->fields[0] as $index => $field)
        {
            return $index;
        }
    }
}