<?php

namespace App\Http\Controller;

use App\Domain\Steam\DTO\SteamCallbackDto;
use App\Domain\Steam\Event\CallbackReceivedEvent;
use App\Domain\Steam\Exception\SteamAuthenticationException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/steam')]
class SteamController extends AbstractController
{
    #[Route(path: '/callback')]
    public function callback(
        #[MapQueryString] SteamCallbackDto $callback,
        EventDispatcherInterface $eventDispatcher,
        UrlGeneratorInterface $urlGenerator,
    ): Response {
        try {
            $eventDispatcher->dispatch(new CallbackReceivedEvent($callback), CallbackReceivedEvent::NAME);
        } catch (SteamAuthenticationException $e) {
            $this->addFlash(
                'error',
                'Steam account could not be linked!'
            );
        }
        $this->addFlash(
            'notice',
            'Steam account linked successfully!'
        );
        return new RedirectResponse($urlGenerator->generate('app_home'));
    }
}
