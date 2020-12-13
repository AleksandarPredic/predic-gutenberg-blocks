<?php

namespace PredicBlocks\ValueObjects;

/**
 * Class Team
 */
class Team
{
    /**
     * Team name
     * @var string
     */
    private $name;

    /**
     * Is home team
     * @var bool
     */
    private $isHome;

    /**
     * Team constructor.
     *
     * @param string $name
     * @param bool $isHome
     */
    public function __construct($name, $isHome) {
        $this->name = $name;
        $this->isHome = $isHome;
    }

    /**
     * Return name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Return if it is a home team
     * @return mixed
     */
    public function isHome() {
        return $this->isHome;
    }
}
