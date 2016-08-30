<?php

namespace Codecasts\Domains\Users\Parsers;

class FacebookParser extends AbstractSocialParser
{
    public function getEmail()
    {
        if (!$this->user->email) {
            return 'cadastre@um.email';
        }
        
        return $this->user->email;
    }
}
