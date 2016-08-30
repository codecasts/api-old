<?php

namespace Codecasts\Domains\Users\Parsers;

use Codecasts\Domains\Users\User;

class GithubParser extends AbstractSocialParser
{
    public function getUsername()
    {
        $username = $this->user->nickname;

        if ($username && User::usernameAvailable($username)) {
            return $username;
        } elseif ($username && !User::usernameAvailable($username)) {
            return $username.$this->getId();
        } else {
            return 'user'.$this->getId();
        }
    }

    public function getName()
    {
        if (!$this->user->full_name) {
            return $this->user->nickname;
        }

        return $this->user->full_name;
    }
}
