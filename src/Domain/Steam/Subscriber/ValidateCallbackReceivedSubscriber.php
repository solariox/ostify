<?php

namespace App\Domain\Steam\Subscriber;

use App\Domain\Steam\Event\CallbackReceivedEvent;
use App\Domain\Steam\Exception\InvalidCallbackPayloadException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ValidateCallbackReceivedSubscriber implements EventSubscriberInterface
{
    const STEAM_VALIDATION_URL = 'https://steamcommunity.com/openid/login';

    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private HttpClientInterface $client
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            CallbackReceivedEvent::NAME => [
                ['onCallbackReceived', 10]
            ]
        ];
    }

    public function onCallbackReceived(CallbackReceivedEvent $event): void
    {
        $callback = $event->getSteamCallback();
        $callback->openid_mode = 'check_authentication';

        $response = $this->client->request(
            'POST',
            self::STEAM_VALIDATION_URL,
            [
                'body' => (array) $callback
            ]
        );

        if (false === str_contains($response->getContent(), 'is_valid:true')) {
            throw new InvalidCallbackPayloadException();
        }

//        $this->eventDispatcher->dispatch(new PayloadValidEvent($callback->getCommunityId()), PayloadValidEvent::NAME);
    }
}

