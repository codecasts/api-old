<?php

namespace Codecasts\Units\User\Http\Controllers;

use Artesaos\Warehouse\Traits\ImplementsFractal;
use Codecasts\Domains\Users\Contracts\UserRepository;
use Codecasts\Support\Http\Controller;

/**
 * Class HomeController.
 */
class UserController extends Controller
{
    use ImplementsFractal;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(UserRepository $repository)
    {
        $user = $repository->findByID(1);

        return $repository->makeResponseCollection(collect([$user]));
    }
}
