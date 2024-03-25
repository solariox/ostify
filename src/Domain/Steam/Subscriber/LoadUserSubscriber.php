<?php

namespace App\Domain\Steam\Subscriber;

use App\Domain\Steam\Event\AuthenticateUserEvent;
use App\Domain\Steam\Event\FirstLoginEvent;
use App\Domain\Steam\Event\PayloadValidEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class LoadUserSubscriber
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private UserProviderInterface $userProvider
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PayloadValidEvent::NAME => [
                ['onPayloadValid', 10],
            ],
        ];
    }

    public function onPayloadValid(PayloadValidEvent $event): void
    {
        $communityId = $event->getCommunityId();

        try {
            $user = $this->userProvider->loadUserByIdentifier($communityId);
        } catch (UserNotFoundException $e) {
            $this->eventDispatcher->dispatch(new FirstLoginEvent($communityId), FirstLoginEvent::NAME);

            return;
        }
        $this->eventDispatcher->dispatch(new AuthenticateUserEvent($user), AuthenticateUserEvent::NAME);
    }

}
