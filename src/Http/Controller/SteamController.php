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
        } catch (SteamAuthenticationException $e) {
            dd($e);
//            return new RedirectResponse(
//                $this->urlGenerator->generate($this->getParameter('knojector.steam_authentication.login_failure_redirect'))
//            );
        }
        return new RedirectResponse($urlGenerator->generate('app_home'));
    }
}
