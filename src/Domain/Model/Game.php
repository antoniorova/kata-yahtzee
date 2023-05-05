<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model;

use Yahtzee\Domain\Model\Categories\CategoryInterface;

class Game
{
    private const DICE_NUMBER = 6;
    private const MAX_ROLLS = 3;
    private const FIRST_ROLL = 1;


    private function __construct(
        private DiceCollection $dice,
        private int $numRoll,
    ) {
    }

    public static function firstRoll(): self
    {
        return new self(
            DiceCollection::random(self::DICE_NUMBER),
            self::FIRST_ROLL
        );
    }

    /** @param array<array-key, int> $rerollDice */
    public function roll(array $rerollDice): void
    {
        if ($this->numRoll >= self::MAX_ROLLS) {
            return;
        }

        $this->dice = $this->dice->rollDice($rerollDice);
        $this->numRoll++;
    }

    public function dice(): DiceCollection
    {
        return $this->dice;
    }

    public function score(CategoryInterface $category): int
    {
        return $category->score($this->dice());
    }
}
