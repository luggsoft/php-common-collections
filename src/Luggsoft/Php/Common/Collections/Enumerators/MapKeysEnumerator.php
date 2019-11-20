<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class MapKeysEnumerator extends EnumeratorBase
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
            $mapper = Collection::getDefaultKeyMapper();
        }
        
        $this->mapper = $mapper;
    }
    
    /**
     *
     * @return EnumeratorFactoryInterface
     */
    public static function getEnumeratorFactory(): EnumeratorFactoryInterface
    {
        return new EnumeratorFactory('mapKeys', function (callable $mapper = null) {
            return new MapKeysEnumerator($mapper);
        });
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        foreach ($collection as $key => $value) {
            yield call_user_func($this->mapper, $value, $key) => $value;
        }
    }
    
}
