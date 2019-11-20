<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class OrderEnumerator extends EnumeratorBase
{
    
    /**
     *
     * @var callable
     */
    private $mapper;
    
    /**
     *
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        if ($mapper === null) {
            $mapper = Collection::getDefaultMapper();
        }
        
        $this->mapper = $mapper;
    }
    
    /**
     *
     * @return EnumeratorFactoryInterface
     */
    public static function getEnumeratorFactory(): EnumeratorFactoryInterface
    {
        return new EnumeratorFactory('order', function (callable $mapper = null) {
            return new OrderEnumerator($mapper);
        });
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        $orderables = $collection->enumerateWith(new MapEnumerator(function ($value, $key) {
            return (object) [
                'key' => $key,
                'value' => $value,
                'index' => call_user_func($this->mapper, $value, $key),
            ];
        }))
            ->toArray();
        
        usort($orderables, function ($orderable1, $orderable2) {
            return $orderable1->index > $orderable2->index ? 1 : 0;
        });
        
        foreach ($orderables as $orderable) {
            yield $orderable->key => $orderable->value;
        }
    }
    
}
