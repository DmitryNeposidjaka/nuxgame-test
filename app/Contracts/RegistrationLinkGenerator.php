<?php

namespace App\Contracts;

interface RegistrationLinkGenerator
{
    public function generate(): string;
}
