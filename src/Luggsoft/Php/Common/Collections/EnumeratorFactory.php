<?php

namespace Luggsoft\Php\Common\Collections;

final class EnumeratorFactory extends EnumeratorFactoryBase
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
    final public function createEnumerator(...$arguments): EnumeratorInterface
    {
        return call_user_func_array($this->callable, $arguments);
    }
    
}
