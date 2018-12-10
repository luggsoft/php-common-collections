<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;
use CrystalCode\Php\Common\Collections\EnumeratorFactory;
use CrystalCode\Php\Common\Collections\EnumeratorFactoryInterface;

class MapKeysEnumerator extends EnumeratorBase
{

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
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        foreach ($collection as $key => $value) {
            yield call_user_func($this->mapper, $value, $key) => $value;
        }
    }

}
