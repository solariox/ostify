<?php

namespace App\Domain\Spotify;

class SpotifyRequestException extends \Exception
{
    public function __construct($message = 'Spotify request failed', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
