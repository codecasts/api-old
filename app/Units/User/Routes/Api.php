<?php

namespace Codecasts\Units\User\Routes;

use Codecasts\Domains\Users\Repositories\UserRepository;
use Codecasts\Support\Http\Routing\RouteFile;

/**
 * Api Routes.
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 */
class Api extends RouteFile
{
    /**
     * Declare API Routes.
     */
    public function routes()
    {
        $this->router->get('/', 'UserController@user');//->middleware('auth:api');
    }
}
