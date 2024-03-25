<?php

namespace App\Domain\Steam\Event;

use Symfony\Contracts\EventDispatcher\Event;

abstract class CommunityIdAwareEvent extends Event
{
    public function __construct(private string $communityId)
    {
    }

    public function getCommunityId(): string
    {
        return $this->communityId;
    }
}
