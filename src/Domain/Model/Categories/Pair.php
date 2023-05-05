<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;

class Pair implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $groupValues = array_count_values($dice->toArray());
        /** @var int[] $pairOrMore */
        $pairOrMore = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 2
        ));

        return $pairOrMore === [] ? 0 : max($pairOrMore) * 2;
    }
}
