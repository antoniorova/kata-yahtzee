<?php

declare(strict_types=1);

namespace Yahtzee\Tests\Domain\Model;

use PHPUnit\Framework\TestCase;
use Yahtzee\Domain\Model\Categories\Chance;
use Yahtzee\Domain\Model\Categories\Fives;
use Yahtzee\Domain\Model\Categories\FourKind;
use Yahtzee\Domain\Model\Categories\Fours;
use Yahtzee\Domain\Model\Categories\Full;
use Yahtzee\Domain\Model\Categories\LargeStraight;
use Yahtzee\Domain\Model\Categories\Ones;
use Yahtzee\Domain\Model\Categories\Pair;
use Yahtzee\Domain\Model\Categories\Sixes;
use Yahtzee\Domain\Model\Categories\SmallStraight;
use Yahtzee\Domain\Model\Categories\ThreeKind;
use Yahtzee\Domain\Model\Categories\Threes;
use Yahtzee\Domain\Model\Categories\TwoPair;
use Yahtzee\Domain\Model\Categories\Twos;
use Yahtzee\Domain\Model\Categories\Yahtzee;
use Yahtzee\Domain\Model\DiceCollection;
use Yahtzee\Domain\Model\Game;
use function sort;

class GameTest extends TestCase
{
    public function testSumOfOnes(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(1);

        $this->assertEquals($result->sum(), $game->score(new Ones()));
    }

    public function testSumOfTwos(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(2);

        $this->assertEquals($result->sum(), $game->score(new Twos()));
    }

    public function testSumOfThrees(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(3);

        $this->assertEquals($result->sum(), $game->score(new Threes()));
    }

    public function testSumOfFours(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(4);

        $this->assertEquals($result->sum(), $game->score(new Fours()));
    }

    public function testSumOfFives(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(5);

        $this->assertEquals($result->sum(), $game->score(new Fives()));
    }

    public function testSumOfSixes(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice();
        $result = $dice->filterBy(6);

        $this->assertEquals($result->sum(),$game->score(new Sixes()));
    }

    public function testPair(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice()->toArray();
        $groupValues = array_count_values($dice);
        $pairOrMore = array_keys(array_filter(
            $groupValues,
            static fn(int $value) => $value >= 2
        ));
        sort($pairOrMore);
        $total = (int)end($pairOrMore) * 2;

        $this->assertEquals($total, $game->score(new Pair()));
    }

    public function testTwoPair(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice()->toArray();
        $groupValues = array_count_values($dice);
        $pairOrMore = array_keys(array_filter(
            $groupValues,
            static fn(int $value) => $value >= 2
        ));
        sort($pairOrMore);
        $total = count($pairOrMore) < 2 ? 0 : (int)array_pop($pairOrMore) * 2 + (int)array_pop($pairOrMore) * 2;

        $this->assertEquals($total, $game->score(new TwoPair()));
    }

    public function testThreeKind(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice()->toArray();
        $groupValues = array_count_values($dice);
        $threeOrMore = array_keys(array_filter(
            $groupValues,
            static fn(int $value) => $value >= 3
        ));
        sort($threeOrMore);
        $total = (int)end($threeOrMore) * 3;

        $this->assertEquals($total, $game->score(new ThreeKind()));
    }

    public function testFourKind(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);

        $dice = $game->dice()->toArray();
        $groupValues = array_count_values($dice);
        $fourOrMore = array_keys(array_filter(
            $groupValues,
            static fn(int $value) => $value >= 4
        ));
        sort($fourOrMore);
        $total = (int)end($fourOrMore) * 4;

        $this->assertEquals($total, $game->score(new FourKind()));
    }

    public function testSmallStraight(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);
        $dice = $game->dice()->toArray();
        sort($dice);
        end($dice);
        $smallStraight = [1,2,3,4,5];
        $expected = count(array_diff($smallStraight, $dice)) > 0 ? 0 : 15;

        $this->assertEquals($expected, $game->score(new SmallStraight()));
    }

    public function testLargeStraight(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $game->roll([3,5]);
        $dice = $game->dice()->toArray();
        sort($dice);
        end($dice);
        $largeStraight = [2,3,4,5,6];
        $expected = count(array_diff($largeStraight, $dice)) > 0 ? 0 : 20;

        $this->assertEquals($expected, $game->score(new LargeStraight()));
    }

    public function testFull(): void
    {
        {
            $game = Game::firstRoll();
            $game->roll([1,3,5]);
            $game->roll([3,5]);
            $dice = $game->dice()->toArray();
            $groupValues = array_count_values($dice);
            $threeGroup = array_keys(array_filter(
                $groupValues,
                static fn(int $value) => $value >= 3
            ));
            foreach ($threeGroup as $key) {
                unset($groupValues[$key]);
            }
            $twoGroup = array_keys(array_filter(
                $groupValues,
                static fn(int $value) => $value >= 2
            ));
            sort($twoGroup);
            $expected = count($threeGroup) === 0 || count($twoGroup) === 0 ? 0 : ((int)end($threeGroup) * 3) + ((int)end($twoGroup) * 2);

            $this->assertEquals($expected, $game->score(new Full()));
        }
    }

    public function testYahtzee(): void
    {
        {
            $game = Game::firstRoll();
            $game->roll([1,3,5]);
            $game->roll([3,5]);
            $dice = $game->dice()->toArray();
            $expected = count(array_unique($dice, SORT_REGULAR)) === 1 ? 50 : 0;

            $this->assertEquals($expected, $game->score(new Yahtzee()));
        }
    }

    public function testChance(): void
    {
        {
            $game = Game::firstRoll();
            $game->roll([1,3,5]);
            $game->roll([3,5]);
            $dice = $game->dice()->toArray();
            $expected = array_sum($dice);

            $this->assertEquals($expected, $game->score(new Chance()));
        }
    }

    public function testLimitRolls(): void
    {
        $game = Game::firstRoll();
        $game->roll([1,3,5]);
        $resultOne = $game->score(new Chance());
        $game->roll([3,5]);
        $dice = $game->dice()->toArray();
        $expected = array_sum($dice);
        $result = $game->score(new Chance());
        $this->assertEquals($expected, $result);
        $this->assertNotEquals($resultOne, $result);

        $game->roll([3,5]);

        $this->assertEquals($result, $game->score(new Chance()));
    }
}
