<?php

namespace App\Steam\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SteamCallbackDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\EqualTo('http://specs.openid.net/auth/2.0')]
        public string $openid_ns,

        #[Assert\NotBlank]
        public string $openid_mode,

        #[Assert\NotBlank]
        #[Assert\EqualTo('https://steamcommunity.com/openid/login')]
        public string $openid_op_endpoint,

        #[Assert\NotBlank]
        #[Assert\Expression('this.openid_claimed_id === this.openid_identity')]
        public string $openid_claimed_id,

        #[Assert\NotBlank]
        public string $openid_identity,

        #[Assert\NotBlank]
//        #[SteamAssert\MatchesLoginCallbackRoute]
        public string $openid_return_to,

        #[Assert\NotBlank]
        public string $openid_response_nonce,

        #[Assert\NotBlank]
        public string $openid_assoc_handle,

        #[Assert\NotBlank]
        public string $openid_signed,

        #[Assert\NotBlank]
        public        $openid_sig,
    )
    {
    }

    public function getCommunityId(): string
    {
        return str_replace('https://steamcommunity.com/openid/id/', '', $this->openid_identity);
    }

}
