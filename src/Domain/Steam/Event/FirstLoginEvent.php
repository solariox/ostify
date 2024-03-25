<?php

namespace App\Domain\Steam\Event;

class FirstLoginEvent extends CommunityIdAwareEvent
{
    CONST NAME = 'app.steam_authentication_bundle.first_login';
}
