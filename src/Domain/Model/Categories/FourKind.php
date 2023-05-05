<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class FourKind implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $groupValues = array_count_values($dice->toArray());
        /** @var int[] $fourOrMore */
        $fourOrMore = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 4
        ));

        return end($fourOrMore) * 4;
    }
}
