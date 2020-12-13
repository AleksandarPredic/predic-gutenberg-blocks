<?php

namespace PredicBlocks\ValueObjects;

/**
 * Class Bookmaker
 * @package PredicBlocks\ValueObjects
 */
class Bookmaker
{
    /**
     * Name
     * @var string
     */
    private $name;

    /**
     * Odds
     * @var array
     */
    private $odds;

    /**
     * Bookmaker constructor.
     *
     * @param string $name
     * @param array $odds
     */
    public function __construct($name, array $odds)
    {
        $this->name = $name;
        $this->odds = $odds;
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
     * Return odds
     * @return array
     */
    public function getOdds()
    {
        return $this->odds;
    }
}
