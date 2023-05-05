<?php

declare(strict_types=1);

namespace Yahtzee\Domain\Model;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<array-key, Dice>
 */
class DiceCollection implements IteratorAggregate, Countable
{
    private const INIT_KEY = 0;

    /** @param Dice[] $dice */
    private function __construct(
        private readonly array $dice
    ) {
    }

    public static function random(int $numberDice): self
    {
        $dice = array_fill(self::INIT_KEY, $numberDice, Dice::random());

        return new self($dice);
    }

    /** @param array<array-key, int> $values */
    public static function fromArray(array $values): self
    {
        $dice = [];
        foreach ($values as $value) {
            $dice[] = Dice::fromInt($value);
        }

        return new self($dice);
    }

    /** @param array<array-key, int> $dicePositions */
    public function rollDice(array $dicePositions): DiceCollection
    {
        $diceBase = $this->dice;
        foreach ($dicePositions as $dice) {
            $diceBase[$dice] = Dice::random();
        }

        return new self($diceBase);
    }

    public function filterBy(int $valueFilter): DiceCollection
    {
        $diceFiltered = array_filter(
            $this->dice,
            static fn (Dice $dice) => $dice->value === $valueFilter
        );

        return new self($diceFiltered);
    }

    public function sum(): int
    {
        return array_sum($this->toArray());
    }

    public function getIterator(): Traversable
    {
        yield from $this->dice;
    }

    public function count(): int
    {
        return count($this->dice);
    }

    /** @return array<array-key, int> */
    public function toArray(): array
    {
        return array_map(
            fn (Dice $dice) => $dice->value,
            $this->dice
        );
    }
}
