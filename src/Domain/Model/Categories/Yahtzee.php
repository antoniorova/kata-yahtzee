<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Yahtzee implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        return count(array_unique($dice->toArray(), SORT_REGULAR)) === 1 ? 50 : 0;
    }
}
