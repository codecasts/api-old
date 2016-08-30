<?php

namespace Codecasts\Domains\Users\Repositories;

use Artesaos\Warehouse\AbstractCrudRepository;
use Artesaos\Warehouse\Traits\ImplementsFractal;
use Codecasts\Domains\Users\Presenters\UserPresenter;
use Codecasts\Domains\Users\User;

use Codecasts\Domains\Users\Contracts\UserRepository as UserRepositoryContract;

class UserRepository extends AbstractCrudRepository implements UserRepositoryContract
{
    use ImplementsFractal;

    protected $modelClass = User::class;

    protected $presenterClass = UserPresenter::class;

    public function getAdmins()
    {
        $query = $this->newQuery();
        $query->where('admin', true);

        return $this->doQuery($query, false, false);
    }

    public function getCount()
    {
        return $this->doQuery(null, false, false)->count();
    }
}
