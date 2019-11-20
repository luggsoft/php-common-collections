<?php

namespace Luggsoft\Php\Common\Collections;

abstract class AggregatorBase implements AggregatorInterface
{
    
    /**
     *
     * @var mixed
     */
    private $initial;
    
    /**
     *
     * @var callable
     */
    private $applicator;
    
    /**
     *
     * @param callable $applicator
     * @param mixed $initial
     */
    function __construct(callable $applicator, $initial = null)
    {
        $this->applicator = $applicator;
        $this->initial = $initial;
    }
    
    /**
     *
     * @return AggregatorFactoryInterface
     */
    abstract static function getAggregatorFactory(): AggregatorFactoryInterface;
    
    /**
     *
     * {@inheritdoc}
     */
    public function aggregate(CollectionInterface $collection)
    {
        $break = false;
        $result = $this->initial;
        foreach ($collection as $key => $item) {
            $result = call_user_func_array($this->applicator, [$result, $item, $key, $collection, &$break]);
            if ($break) {
                break;
            }
        }
        return $result;
    }
    
}
