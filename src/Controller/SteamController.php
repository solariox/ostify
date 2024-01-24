<?php

namespace App\Controller;

use App\Steam\DTO\SteamCallbackDto;
use App\Steam\Event\CallbackReceivedEvent;
use App\Steam\Exception\SteamAuthenticationException;
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
    ): Response
    {
        dump($callback);
        try {
            $eventDispatcher->dispatch(new CallbackReceivedEvent($callback), CallbackReceivedEvent::NAME);
        } catch (SteamAuthenticationException $e) {
            dump($e);
//            return new RedirectResponse(
//                $this->urlGenerator->generate($this->getParameter('knojector.steam_authentication.login_failure_redirect'))
//            );
        }
        return new RedirectResponse($urlGenerator->generate('app_home'));
    }
}
