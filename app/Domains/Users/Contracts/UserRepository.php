<?php

namespace Codecasts\Domains\Users\Contracts;

use Artesaos\Warehouse\Contracts\BaseRepository;
use Artesaos\Warehouse\Contracts\Segregated\CrudRepository;

interface UserRepository extends CrudRepository, BaseRepository
{
    public function getAdmins();

    public function getCount();
}
