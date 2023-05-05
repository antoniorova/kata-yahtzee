<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Sixes;
use Yahtzee\Domain\Model\DiceCollection;

class SixesTest extends TestCase
{
    public function testFoursCorrectScoreWithDiceProvided(): void
    {
        $sixes = new Sixes();
        $this->assertEquals(12, $sixes->score(DiceCollection::fromArray([3,5,6,6,3,4])));
    }
}
