<?php

namespace App\Services;

use App\Contracts\RandomNumberGenerator;

class RandomNumberService implements RandomNumberGenerator
{
    public function generate(int $min, int $max): int
    {
        return random_int($min, $max);
    }
}
