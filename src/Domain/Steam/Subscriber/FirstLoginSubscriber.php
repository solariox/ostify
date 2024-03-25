<?php

namespace App\Domain\Steam\Subscriber;

use App\Domain\Auth\User;
use App\Domain\Steam\Event\FirstLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FirstLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {}

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FirstLoginEvent::NAME => 'onFirstLogin'
        ];
    }

    public function onFirstLogin(FirstLoginEvent $event)
    {
        $communityId = $event->getCommunityId();
        dd($communityId);

        // Check if we are log or not, if steamID is already in the database
        $user = new User();
        $user->setSteamId($communityId);

        // e.g. call the Steam API to fetch more profile information
        // e.g. create user entity and persist it

    }
}
