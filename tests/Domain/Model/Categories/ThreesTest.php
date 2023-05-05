<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Threes;
use Yahtzee\Domain\Model\DiceCollection;

class ThreesTest extends TestCase
{
    public function testThreesCorrectScoreWithDiceProvided(): void
    {
        $threes = new Threes();
        $this->assertEquals(6, $threes->score(DiceCollection::fromArray([3,2,6,4,3,4])));
    }
}
