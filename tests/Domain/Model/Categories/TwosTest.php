<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Twos;
use Yahtzee\Domain\Model\DiceCollection;

class TwosTest extends TestCase
{
    public function testTwosCorrectScoreWithDiceProvided(): void
    {
        $twos = new Twos();
        $this->assertEquals(4, $twos->score(DiceCollection::fromArray([2,2,6,4,3,4])));
    }
}