<?php

namespace CrystalCode\Php\Common\Collections;

abstract class AggregatorFactoryBase implements AggregatorFactoryInterface
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
