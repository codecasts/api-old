<?php

namespace Codecasts\Units\User\Http\Controllers;

use Codecasts\Domains\Users\Contracts\UserRepository;
use Codecasts\Domains\Users\Transformers\UsersTransformer;
use Codecasts\Units\Core\Http\Controller;
use Illuminate\Contracts\Auth\Guard;


/**
 * Class HomeController.
 */
class UserController extends Controller
{
    protected $transformerClass = UsersTransformer::class;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Guard $auth)
    {
        return $auth->user();

        //return $this->makeResponseCollection($users);
    }
}
