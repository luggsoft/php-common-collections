<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class MapEnumerator extends EnumeratorBase
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
        return new EnumeratorFactory('map', function (callable $mapper = null) {
            return new MapEnumerator($mapper);
        });
    }
    
    /**
     *
     * @param array $segments
     * @return MapEnumerator
     */
    public static function createFromSegments(array $segments)
    {
        return new MapEnumerator(function ($value) use ($segments) {
            foreach ($segments as $segment) {
                if (is_object($value)) {
                    $value = $value->{$segment};
                    continue;
                }
                
                if (is_array($value)) {
                    $value = $value[$segment];
                    continue;
                }
                
                return null;
            }
            return $value;
        });
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        foreach ($collection as $key => $value) {
            yield $key => call_user_func($this->mapper, $value, $key);
        }
    }
    
}
