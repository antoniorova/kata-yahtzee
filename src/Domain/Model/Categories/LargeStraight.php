<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class LargeStraight implements CategoryInterface
{
    private const EXPECTED = [2, 3, 4, 5, 6];

    public function score(DiceCollection $dice): int
    {
        $dice = array_unique($dice->toArray());
        sort($dice);

        return count(array_diff(self::EXPECTED, $dice)) > 0 ? 0 : 20;
    }
}
