<?php

namespace App\Domain\Spotify;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SpotifyWebApi
{

    public const ACCOUNT_URL = 'https://accounts.spotify.com';
    public const API_URL = 'https://api.spotify.com';
//    protected ?SpotifySession $session = null;
    protected ?string $accessToken = null;

    public function __construct(
        #[Autowire(env: 'SPOTIFY_CLIENT_ID')]
        protected string $spotifyClientId,
        #[Autowire(env: 'SPOTIFY_CLIENT_SECRET')]
        protected string $spotifyClientSecret,
        protected HttpClientInterface $client,
        protected RequestStack $requestStack,
    ) {
        $this->accessToken = $this->requestStack->getSession()->get('spotify_access_token');
        if (!$this->accessToken) {
            $this->accessToken = $this->requestAccessToken();
            $this->requestStack->getSession()->set('spotify_access_token', $this->accessToken);
        }
    }

    private function requestAccessToken(): string
    {
        $response = $this->client->request(
            'POST',
            self::ACCOUNT_URL . '/api/token',
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->spotifyClientId,
                    'client_secret' => $this->spotifyClientSecret,
                ],
            ]
        );

        $response = json_decode($response->getContent());
        if (!isset($response->access_token)) {
            throw new SpotifyRequestException();
        }

        return $response->access_token;
    }

    public function search(
        string $query,
//        array $types,
//        ?string $market = null,
//        int $limit = self::DEFAULT_LIMIT,
//        int $offset = self::DEFAULT_OFFSET,
//        ?bool $includeExternalAudio = null
    )
    {
        $payload = [
            'q' => $query,
            'type' => 'album',
//            'limit' => $this->prepareLimit($limit),
//            'offset' => $this->prepareOffset($offset),
        ];

        $response = $this->request('GET', '/v1/search', $payload);
        return json_decode($response->getContent());
    }

    private function request(string $method, string $uri, array $params): ResponseInterface
    {
//        $request = (new Request())
//            ->setAuthorization($this->authorizationToken)
//            ->setEndpoint(self::SEARCH_ENDPOINT)
//            ->setMethod('GET')
//            ->setBearerAuthorization($authorizationToken)
//            ->setPayload($payload);
        $url = self::API_URL . $uri . '?' . http_build_query($params);

        return $this->client->request(
            $method,
            $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ],
        );
    }

}
