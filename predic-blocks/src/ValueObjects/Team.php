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
     * team id
     * @var string
     */
    private $id;

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
    public function __construct($name, $isHome)
    {
        $this->name = $name;
        $this->isHome = $isHome;
        $this->id = self::generateId($name);
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

    /**
     * Return if it is a home team
     * @return mixed
     */
    public function isHome()
    {
        return $this->isHome;
    }

    /**
     * Generate id form name
     * @param string $name
     *
     * @return string
     */
    public static function generateId($name)
    {
        return sanitize_file_name(
            strtolower($name)
        );
    }
}
