<?php

declare(strict_types=1);

namespace Kata;

use Kata\Planet\Field;
use Kata\Planet\Obstacle;
use Kata\Planet\Planet;
use PHPUnit\Framework\TestCase;

final class MarsRowerTest extends TestCase
{
    /**
     * @test
     * @dataProvider moveProvider
     */
    public function whenRoverMove($position, $direction, $moveDirection, $expectedX, $expectedY, $expectedDirection): void
    {
        $planet = new Planet([
            -3 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -2 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -1 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            0  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            1  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            2  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            3  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
        ]);

        $rover = new MarsRover($position, $direction, $planet);

        $move = $rover->move($moveDirection);

        $this->assertSame($expectedX, $move->getPosition()->getX());
        $this->assertSame($expectedY, $move->getPosition()->getY());
        $this->assertTrue($move->getDirection()->equals($expectedDirection));
    }

    public function moveProvider(): array
    {
        return [
            // West
            0  => [new Position(0, 0), Direction::WEST(), MoveDirection::FORWARD(), -1, 0, Direction::WEST()],
            1  => [new Position(0, 0), Direction::WEST(), MoveDirection::BACKWARD(), +1, 0, Direction::WEST()],
            2  => [new Position(0, 0), Direction::WEST(), MoveDirection::RIGHT(), 0, 1, Direction::NORTH()],
            3  => [new Position(0, 0), Direction::WEST(), MoveDirection::LEFT(), 0, -1, Direction::SOUTH()],
            //  EAST
            4  => [new Position(0, 0), Direction::EAST(), MoveDirection::FORWARD(), 1, 0, Direction::EAST()],
            5  => [new Position(0, 0), Direction::EAST(), MoveDirection::BACKWARD(), -1, 0, Direction::EAST()],
            6  => [new Position(0, 0), Direction::EAST(), MoveDirection::RIGHT(), 0, -1, Direction::SOUTH()],
            7  => [new Position(0, 0), Direction::EAST(), MoveDirection::LEFT(), 0, 1, Direction::NORTH()],
            //  NORTH
            8  => [new Position(0, 0), Direction::NORTH(), MoveDirection::FORWARD(), 0, 1, Direction::NORTH()],
            9  => [new Position(0, 0), Direction::NORTH(), MoveDirection::BACKWARD(), 0, -1, Direction::NORTH()],
            10 => [new Position(0, 0), Direction::NORTH(), MoveDirection::RIGHT(), 1, 0, Direction::EAST()],
            11 => [new Position(0, 0), Direction::NORTH(), MoveDirection::LEFT(), -1, 0, Direction::WEST()],
            //  SOUTH
            12 => [new Position(0, 0), Direction::SOUTH(), MoveDirection::FORWARD(), 0, -1, Direction::SOUTH()],
            13 => [new Position(0, 0), Direction::SOUTH(), MoveDirection::BACKWARD(), 0, 1, Direction::SOUTH()],
            14 => [new Position(0, 0), Direction::SOUTH(), MoveDirection::RIGHT(), -1, 0, Direction::WEST()],
            15 => [new Position(0, 0), Direction::SOUTH(), MoveDirection::LEFT(), 1, 0, Direction::EAST()],
        ];
    }

    /**
     * @test
     */
    public function whenRoverFindObstacle(): void
    {
        $planet = new Planet([
            -3 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -2 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -1 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            0  => [-1 => new Field(), 0 => new Field(), 1 => new Obstacle(), 2 => new Field()],
            1  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            2  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            3  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
        ]);
        $rover  = new MarsRover(new Position(0, 0), Direction::NORTH(), $planet);

        $move = $rover->move(MoveDirection::RIGHT());

        $this->assertSame(0, $move->getPosition()->getX());
        $this->assertSame(0, $move->getPosition()->getY());
        $this->assertCount(1, $rover->getObstacleEvents());
    }

    /**
     * @test
     * @dataProvider gridResetProvider
     */
    public function whenRoverGridReset($position, $direction, $moveDirection, $expectedX, $expectedY, $expectedDirection): void
    {
        $planet = new Planet([
            -3 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -2 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            -1 => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            0  => [-1 => new Field(), 0 => new Field(), 1 => new Obstacle(), 2 => new Field()],
            1  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            2  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
            3  => [-1 => new Field(), 0 => new Field(), 1 => new Field(), 2 => new Field()],
        ]);
        $rover  = new MarsRover($position, $direction, $planet);

        $move = $rover->move($moveDirection);

        $this->assertSame($expectedX, $move->getPosition()->getX());
        $this->assertSame($expectedY, $move->getPosition()->getY());
        $this->assertTrue($move->getDirection()->equals($expectedDirection));
    }

    public function gridResetProvider(): array
    {
        return [
            0 => [new Position(0, 3), Direction::NORTH(), MoveDirection::FORWARD(), 0, -3, Direction::NORTH()],
            1 => [new Position(0, -3), Direction::NORTH(), MoveDirection::BACKWARD(), 0, 3, Direction::NORTH()],
            2 => [new Position(2, 0), Direction::NORTH(), MoveDirection::RIGHT(), -1, 0, Direction::EAST()],
            3 => [new Position(-1, 0), Direction::NORTH(), MoveDirection::LEFT(), 2, 0, Direction::WEST()],
        ];
    }
}
