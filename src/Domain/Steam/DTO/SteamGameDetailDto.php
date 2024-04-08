<?php

namespace App\Domain\Steam\DTO;
class SteamGameDetailDto
{
    public function __construct(
        public ?string $type = null,
        public ?string $name = null,
        public ?string $steam_appid = null,
        public ?string $required_age = null,
        public ?string $is_free = null,
        public ?array $dlc = null,
        public ?string $detailed_description = null,
        public ?string $about_the_game = null,
        public ?string $short_description = null,
        public ?string $supported_languages = null,
        public ?string $reviews = null,
        public ?string $header_image = null,
        public ?string $capsule_image = null,
        public ?string $capsule_imagev5 = null,
        public ?string $website = null,
        public ?array $pc_requirements = null,
        public ?array $mac_requirements = null,
        public ?array $linux_requirements = null,
        public ?string $legal_notice = null,
        public ?array $developers = null,
        public ?array $publishers = null,
        public ?array $price_overview = null,
        public ?array $packages = null,
        public ?array $package_groups = null,
        public ?array $platforms = null,
        public ?array $metacritic = null,
        public ?array $categories = null,
        public ?array $genres = null,
        public ?array $screenshots = null,
        public ?array $recommendations = null,
        public ?array $achievements = null,
        public ?array $release_date = null,
        public ?array $support_info = null,
        public ?string $background = null,
        public ?string $background_raw = null,
        public ?array $content_descriptors = null,
        public ?array $ratings = null,
        public ?string $controller_support = null,
        public ?array $demos = null,
        public ?array $movies = null,
    ) {
    }
}

