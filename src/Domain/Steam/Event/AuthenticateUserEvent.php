<?php

namespace App\Domain\Steam\Event;

use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticateUserEvent extends CommunityIdAwareEvent
{
    CONST NAME = 'app.steam_authentication_bundle.authenticate_user';

    public function __construct(protected UserInterface $user)
    {}

    public function getUser(): UserInterface
    {
        return $this->user;
    }}
