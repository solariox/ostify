<?php

namespace App\Domain\Steam\Subscriber;

use App\Domain\Auth\User;
use App\Domain\Steam\Event\AuthenticateUserEvent;
use App\Domain\Steam\Event\FirstLoginEvent;
use App\Domain\Steam\SteamService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FirstLoginSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly EntityManagerInterface $entityManager,
        private readonly SteamService $steamService,
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

        $user = new User();
        $user->setSteamId($communityId);
        $user = $this->steamService->updateUserInfoFromSteam($user);
        $this->entityManager->persist($user);
        $this->entityManager->flush();


        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);
    }
}
