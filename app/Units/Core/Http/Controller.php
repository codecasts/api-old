<?php

namespace Codecasts\Units\Core\Http;

use Codecasts\Support\Http\ApiResponseBuilder;
use Codecasts\Support\Http\Controller as BaseController;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    /**
     * @var string
     */
    protected $transformerClass;

    /**
     * @return ApiResponseBuilder
     */
    protected function response()
    {
        return new ApiResponseBuilder($this->transformerClass);
    }

}