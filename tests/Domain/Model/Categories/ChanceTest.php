<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Chance;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\Full;
use Yahtzee\Domain\Model\Categories\LargeStraight;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\DiceCollection;

class ChanceTest extends TestCase
{
    public function testChanceCorrectScoreWithDiceProvided(): void
    {
        $chance = new Chance();
        $this->assertEquals(21, $chance->score(DiceCollection::fromArray([1,2,3,4,5,6])));
    }
}
