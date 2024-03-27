<?php

namespace App\Domain\Steam\DTO;

class SteamGameDto
{
    public function __construct(
        public ?string $appid = null,
        public ?string $playtime_forever = null,
        public ?string $playtime_windows_forever = null,
        public ?string $playtime_mac_forever = null,
        public ?string $playtime_linux_forever = null,
        public ?string $playtime_deck_forever = null,
        public ?string $rtime_last_played = null,
        public ?string $playtime_disconnected = null,
        public ?string $playtime_2weeks = null,
        public ?string $name = null,
    ) {
    }

}
