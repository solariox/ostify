<?php

namespace App\Domain\Steam\Subscriber;

use App\Domain\Auth\User;
use App\Domain\Steam\Event\AuthenticateUserEvent;
use App\Domain\Steam\Event\FirstLoginEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FirstLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FirstLoginEvent::NAME => 'onFirstLogin',
        ];
    }

    public function onFirstLogin(FirstLoginEvent $event)
    {
        $communityId = $event->getCommunityId();

        // Check if we are log or not, if steamID is already in the database
        $user = new User();
        $user->setSteamId($communityId);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // e.g. call the Steam API to fetch more profile information
        // e.g. create user entity and persist it
        //            $steamKey = $_ENV['STEAM_API_KEY'];
//            $steamGamesRequest = $client->request(
//                'GET',
//                sprintf(
//                    "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=%s&steamid=%s&format=json",
//                    $steamKey,
//                    $callback->getCommunityId()),
//            );
//            $steamGamesInfo = $steamGamesRequest->toArray();
//            dump($steamGamesInfo);
        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);
    }
}
