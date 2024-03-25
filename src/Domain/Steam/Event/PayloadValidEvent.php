<?php

namespace App\Domain\Steam\Event;

class PayloadValidEvent extends CommunityIdAwareEvent
{
    CONST NAME = 'app.steam_authentication_bundle.payload_valid';
}
