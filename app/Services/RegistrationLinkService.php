<?php

namespace App\Services;

use App\Contracts\RegistrationLinkGenerator;

class RegistrationLinkService implements RegistrationLinkGenerator
{
    public function generate(): string
    {
        return bin2hex(random_bytes(32));
    }
}
