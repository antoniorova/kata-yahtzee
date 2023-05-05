<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model\Categories;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Ones;
use Yahtzee\Domain\Model\DiceCollection;

class OnesTest extends TestCase
{
    public function testOnesCorrectScoreWithDiceProvided(): void
    {
        $ones = new Ones();
        $this->assertEquals(3, $ones->score(DiceCollection::fromArray([1,2,2,1,1,2])));
    }
}