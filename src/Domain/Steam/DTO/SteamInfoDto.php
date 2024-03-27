<?php

namespace App\Domain\Steam\DTO;

class SteamInfoDto
{
    public function __construct(
        public string $steamid,
        public string $communityvisibilitystate,
        public string $profilestate,
        public string $personaname,
        public string $profileurl,
        public string $avatar,
        public string $avatarmedium,
        public string $avatarfull,
        public string $avatarhash,
        public string $lastlogoff,
        public string $personastate,
        public string $realname,
        public string $primaryclanid,
        public string $timecreated,
        public string $personastateflags,
        public string $loccountrycode,
    ) {
    }

}
