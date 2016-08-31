<?php

namespace Codecasts\Units\Auth\Http\Controllers;

use AdamWathan\EloquentOAuth\OAuthManager;
use Codecasts\Domains\Users\Parsers\ParserResolver;
use Codecasts\Domains\Users\User;
use Codecasts\Support\Http\Controller;
use Illuminate\Contracts\Auth\Guard;
use SocialNorm\Exceptions\ApplicationRejectedException;
use Tymon\JWTAuth\Facades\JWTAuth;


class SocialController extends Controller
{
    /**
     * @var Guard
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->social = app('adamwathan.oauth');

        $this->middleware('guest');


    }

    public function login($driver)
    {
        return $this->social->authorize($driver);
    }

    public function callback($driver)
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

        $token = JWTAuth::fromUser($this->user);

        $this->auth->logout();

        return response()->json(compact('token'));
    }

}
