<?php

namespace Codecasts\Units\Auth\Routes;

use Codecasts\Support\Http\Routing\RouteFile;

/**
 * Web Routes.
 *
 * This file is where you may define all of the routes that are handled
 * by your application. Just tell Laravel the URIs it should respond
 * to using a Closure or controller method. Build something great!
 */
class Web extends RouteFile
{
    /**
     * Declare Web Routes.
     */
    public function routes()
    {
        // Register Social Routes
        $this->router->get('login/{driver}', [
            'as' => 'auth.social.login',
            'uses' => 'SocialController@login'
        ]);
    }
}
