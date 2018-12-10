<?php

namespace CrystalCode\Php\Common\Collections;

abstract class EnumeratorFactoryBase implements EnumeratorFactoryInterface
{

    /**
     *
     * @var string
     */
    private $name;

    /**
     * 
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * 
     * @return string
     */
    final public function getName(): string
    {
        return $this->name;
    }

}
