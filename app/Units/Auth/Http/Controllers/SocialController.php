<?php

namespace Codecasts\Units\Auth\Http\Controllers;


use Codecasts\Support\Oauth\SessionGrant;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use AdamWathan\EloquentOAuth\OAuthManager;
use Codecasts\Domains\Users\Parsers\ParserResolver;
use Codecasts\Domains\Users\User;
use Codecasts\Support\Http\Controller;
use Illuminate\Contracts\Auth\Guard;
use Psr\Http\Message\ServerRequestInterface;
use SocialNorm\Exceptions\ApplicationRejectedException;
use Laravel\Passport\Bridge;


class SocialController extends Controller
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @var OAuthManager
     */
    protected $social;

    /**
     * The authorization server.
     *
     * @var AuthorizationServer
     */
    protected $server;

    /**
     * The token repository instance.
     *
     * @var TokenRepository
     */
    protected $tokens;

    /**
     * The JWT parser instance.
     *
     * @var JwtParser
     */
    protected $jwt;

    public function __construct(Guard $auth,
                                AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        $this->auth = $auth;
        $this->social = app('adamwathan.oauth');
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;

        $this->server->enableGrantType(new SessionGrant(), Passport::tokensExpireIn());

        $this->middleware('guest', ['except' => 'logout']);


    }

    public function login($driver)
    {
        return $this->social->authorize($driver);
    }

    public function callback($driver, ServerRequestInterface $request)
    {
        try {
            $user = $this->social->login($driver, function (User $user, $details) use ($driver) {

                $resolver = new ParserResolver($driver, $details);

                $parser = $resolver->resolve();

                $user->fillSocialData($parser);

                $user->save();

                $this->auth->login($user, true);


                //$user->createCustomerId();

                //$user->loadSubscription();

                $this->user = $user;

            });
        } catch (ApplicationRejectedException $e) {
            return ['error' => 'application rejected'];
        }

        $response = $this->server
            ->respondToAccessTokenRequest(
                $request,
                new \GuzzleHttp\Psr7\Response()
            );

        $this->auth->logout();

        return response()->json(json_decode((string) $response->getBody()));
    }

}
