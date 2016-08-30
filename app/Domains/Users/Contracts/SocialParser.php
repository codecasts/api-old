<?php

namespace Codecasts\Domains\Users\Contracts;

use SocialNorm\User;

interface SocialParser
{
    public function __construct(User $user);

    public function getId();

    public function getName();

    public function getUsername();

    public function getAvatar();

    public function getEmail();
}
