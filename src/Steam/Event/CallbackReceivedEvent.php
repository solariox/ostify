<?php

namespace App\Steam\Event;

use App\Steam\DTO\SteamCallbackDto;
use Symfony\Contracts\EventDispatcher\Event;
class CallbackReceivedEvent extends Event
{
    CONST NAME = 'app.steam.callback_received';

    public function __construct(protected SteamCallbackDto $steamCallback)
    {}

    public function getSteamCallback(): SteamCallbackDto
    {
        return $this->steamCallback;
    }
}
