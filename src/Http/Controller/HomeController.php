<?php

namespace App\Http\Controller;

use App\Domain\Auth\User;
use App\Domain\Spotify\SpotifyWebApi;
use App\Domain\Steam\SteamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private SteamService $steamService,
        private SpotifyWebApi $spotifyService,
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user) {
            $games = $this->steamService->getAllGamesOfUser($user);
            $steamInfoDto = $this->steamService->updateUserInfoFromSteam($user);
            $spotifyData = [];
            foreach ($games as $game) {
                $spotifyData[$game->steam_appid] = $this->spotifyService->search($game->name);
            }
        }


        return $this->render('home/index.html.twig', [
            'steamInfoDto' => $steamInfoDto ?? null,
            'games' => $games ?? null,
            'spotifyData' => $spotifyData ?? null,
        ]);
    }
}
