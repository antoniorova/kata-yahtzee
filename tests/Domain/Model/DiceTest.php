<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model;

use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;
use Yahtzee\Domain\Model\Dice;

class DiceTest extends TestCase
{
    public function testExceptionNotAllowedValueForDice(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Dice::fromInt(10);
    }
}