<?php

namespace App\Services;

use App\Contracts\RandomNumberGenerator;

class LuckyGameService
{
    public function __construct(
        private RandomNumberGenerator $randomNumberGenerator,
    ) {
    }

    public function play(): array
    {
        $number = $this->randomNumberGenerator->generate(1, 1000);

        $isWin = $number % 2 === 0;

        return [
            'number' => $number,
            'is_win' => $isWin,
            'win_amount' => $isWin
                ? $this->calculateWinAmount($number)
                : 0,
            'rules_version' => 'v1',
        ];
    }

    private function calculateWinAmount(int $number): float
    {
        $percentage = match (true) {
            $number > 900 => 70,
            $number > 600 => 50,
            $number > 300 => 30,
            default => 10,
        };

        return round(
            $number * $percentage / 100,
            2
        );
    }
}
