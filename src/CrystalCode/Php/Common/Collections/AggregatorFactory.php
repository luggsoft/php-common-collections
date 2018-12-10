<?php

namespace CrystalCode\Php\Common\Collections;

final class AggregatorFactory extends AggregatorFactoryBase
{

    /**
     *
     * @var callable
     */
    private $callable;

    /**
     * 
     * @param string $name
     * @param callable $callable
     */
    public function __construct(string $name, callable $callable)
    {
        parent::__construct($name);
        $this->callable = $callable;
    }

    /**
     * 
     * {@inheritdoc}
     */
    final public function createAggregator(...$arguments): AggregatorInterface
    {
        return call_user_func_array($this->callable, $arguments);
    }

}
