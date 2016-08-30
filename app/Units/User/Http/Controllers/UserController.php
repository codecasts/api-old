<?php

namespace Codecasts\Units\User\Http\Controllers;

use Codecasts\Domains\Users\Contracts\UserRepository;
use Codecasts\Domains\Users\Transformers\UsersTransformer;
use Codecasts\Units\Core\Http\Controller;


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
    public function user(UserRepository $repository)
    {
        //return $this->response()->noContent();
        $users = $repository->getAll();

        return $this->response()->collection($users);

        //return $this->makeResponseCollection($users);
    }
}
