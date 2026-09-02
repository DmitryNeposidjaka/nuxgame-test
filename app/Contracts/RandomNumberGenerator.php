<?php

namespace App\Contracts;

interface RandomNumberGenerator
{
    public function generate(int $min, int $max): int;
}
