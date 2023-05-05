<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model\Categories;

use Yahtzee\Domain\Model\DiceCollection;
use function sort;

class TwoPair implements CategoryInterface
{
    public function score(DiceCollection $dice): int
    {
        $groupValues = array_count_values($dice->toArray());
        /** @var int[] $pairOrMore */
        $pairOrMore = array_keys(array_filter(
            $groupValues,
            static fn (int $value) => $value >= 2
        ));
        if (count($pairOrMore) < 2) {
            return 0;
        }
        sort($pairOrMore);
        $pairOne = array_pop($pairOrMore);
        $pairTwo = array_pop($pairOrMore);
        return ($pairOne * 2) + ($pairTwo * 2);
    }
}
