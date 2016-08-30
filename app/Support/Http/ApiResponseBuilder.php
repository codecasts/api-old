<?php

namespace Codecasts\Support\Http;

use Artesaos\Warehouse\Traits\ImplementsFractal;

/**
 * Class ApiResponseBuilder.
 */
class ApiResponseBuilder
{
    /**
     * Use Fractals and import the Api responses trait
     */
    use ImplementsFractal;

    public function __construct($transformerClass = null)
    {
        $this->transformerClass = $transformerClass;
    }

    /**
     * @var string Default transformer class for responses.
     */
    protected $transformerClass;

    /**
     * @param $transformerClass
     * @return $this
     */
    protected function customTransformer($transformerClass)
    {
        $this->transformerClass = $transformerClass;

        return $this;
    }

    public function item($item, $customCode = 200)
    {
        return $this->build($customCode, 'Ok', $this->makeResponseItem($item));
    }

    public function collection($collection, $customCode = 200)
    {
        return $this->build($customCode, 'Ok', $this->makeResponseCollection($collection));
    }

    public function noContent()
    {
        return $this->build(204);
    }

    protected function build($status = 200,
                                       $statusMessage = '',
                                       $data = null,
                                       $headers = [],
                                       $options = 0)
    {

        $data = array_merge(['message' => $statusMessage], $data);

        return response()->json($data, $status, $headers, $options);
    }
}