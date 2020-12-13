<?php

namespace PredicBlocks\ValueObjects;

/**
 * Class Sport
 * @package PredicBlocks\ValueObjects
 */
class Sport
{
    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * Id
     * @var string
     */
    private $id;

    /**
     * Sport constructor.
     *
     * @param string $name
     * @param string $id
     */
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Return name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
