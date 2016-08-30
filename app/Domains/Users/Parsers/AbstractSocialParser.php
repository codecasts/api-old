<?php

namespace Codecasts\Domains\Users\Parsers;

use Codecasts\Domains\Users\Contracts\SocialParser;
use Codecasts\Domains\Users\User;
use SocialNorm\User as SocialUser;

abstract class AbstractSocialParser implements SocialParser
{
    /**
     * @var SocialUser
     */
    protected $user = [];

    /**
     * FacebookParser constructor.
     *
     * @param SocialUser $user
     */
    public function __construct(SocialUser $user)
    {
        $this->user = $user;
    }

    protected function getRawData($key)
    {
        if (array_key_exists($key, $this->user->raw())) {
            $raw = $this->user->raw();

            return $raw[$key];
        }

        return;
    }

    public function getId()
    {
        return $this->user->id;
    }

    public function getName()
    {
        return $this->user->full_name;
    }

    public function getAvatar()
    {
        return $this->user->avatar;
    }

    public function getEmail()
    {
        return $this->user->email;
    }

    public function getUsername()
    {
        $username = str_slug($this->getName(), '_');

        if ($username && User::usernameAvailable($username)) {
            return $username;
        } elseif ($username && !User::usernameAvailable($username)) {
            return $username.$this->getId();
        } else {
            return 'user'.$this->getId();
        }
    }
}
