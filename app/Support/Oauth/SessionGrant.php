<?php

namespace Codecasts\Support\Oauth;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\User;
use Laravel\Passport\Passport;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;


/**
 * Class SessionGrantType.
 */
class SessionGrant extends AbstractGrant
{

    public function getIdentifier()
    {
        return 'session';
    }

    public function respondToAccessTokenRequest(
        ServerRequestInterface $request,
        ResponseTypeInterface $responseType,
        \DateInterval $accessTokenTTL
    )
    {

        $this->setRefreshTokenRepository(
            new RefreshTokenRepository(app('db')->connection())
        );

        $this->refreshTokenTTL = new \DateInterval('P1M');

        // Validate request
        $client = new \Laravel\Passport\Bridge\Client(
            2, 'Session Grant', 'http://localhost'
        );

        $scopes = $this->validateScopes('');
        $user = new User(app('auth')->user()->id);

        // Finalize the requested scopes
        $scopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());

        // Issue and persist new tokens
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);

        // Inject tokens into response
        $responseType->setAccessToken($accessToken);
        $responseType->setRefreshToken($refreshToken);

        return $responseType;
    }
}