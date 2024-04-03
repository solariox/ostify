<?php

namespace App\Domain\Steam;

use App\Domain\Auth\User;
use App\Domain\Steam\DTO\SteamGameDetailDto;
use App\Domain\Steam\DTO\SteamGameDto;
use App\Domain\Steam\DTO\SteamInfoDto;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SteamService
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function getAllGamesOfUser(User $user): array
    {
        $steamKey = $_ENV['STEAM_API_KEY'];
        $steamGamesRequest = $this->client->request(
            'GET',
            sprintf(
                "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=%s&steamid=%s&format=json",
                $steamKey,
                $user->getSteamId(),
            ));

        $steamGamesInfo = array_map(function ($game) {
            $dto = new SteamGameDto(...$game);
            // fetch game details
            $steamGameRequest = $this->client->request(
                'GET',
                sprintf(
                    "https://store.steampowered.com/api/appdetails?appids=%s",
                    $dto->appid,
                ));
            $gameDetailDto = new SteamGameDetailDto(...$steamGameRequest->toArray()[$dto->appid]['data']);
            return $gameDetailDto;
        }, array_slice($steamGamesRequest->toArray()['response']['games'], 0, 2));

        return $steamGamesInfo;
    }

    public function updateUserInfoFromSteam(User $user): SteamInfoDto
    {
        $steamKey = $_ENV['STEAM_API_KEY'];
        $steamUserRequest = $this->client->request(
            'GET',
            sprintf(
                "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s&format=json",
                $steamKey,
                $user->getSteamId(),
            ));
        $steamInfoDto = new SteamInfoDto(...$steamUserRequest->toArray()['response']['players'][0]);
        return $steamInfoDto;
    }

}
