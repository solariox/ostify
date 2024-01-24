<?php

namespace App\Steam\DTO\SteamAssert;

use Symfony\Component\Validator\Constraint;


#[\Attribute]
class MatchesLoginCallbackRoute extends Constraint
{
    public string $message = 'The parameter "openid_return_to" with value "{{ url }}" does not match original callback url "{{ expected }}".';

}
