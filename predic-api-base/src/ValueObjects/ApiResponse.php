<?php

namespace PredicApiBase\ValueObjects;

/**
 * Class ApiResponse
 * @package PredicApiBase\ValueObjects
 */
class ApiResponse
{

    /**
     * Response data
     * @var array
     */
    private $data;

    /**
     * ApiResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Return response data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
