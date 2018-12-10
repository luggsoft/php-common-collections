<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;
use CrystalCode\Php\Common\Collections\EnumeratorFactory;
use CrystalCode\Php\Common\Collections\EnumeratorFactoryInterface;

class FilterEnumerator extends EnumeratorBase
{

    /**
     * 
     * @return EnumeratorFactoryInterface
     */
    public static function getEnumeratorFactory(): EnumeratorFactoryInterface
    {
        return new EnumeratorFactory('filter', function (callable $predicate = null) {
            return new FilterEnumerator($predicate);
        });
    }

    /**
     *
     * @var callable
     */
    private $predicate;

    /**
     * 
     * @param callable $predicate
     */
    public function __construct(callable $predicate = null)
    {
        if ($predicate === null) {
            $predicate = Collection::getDefaultPredicate();
        }

        $this->predicate = $predicate;
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        foreach ($collection as $key => $value) {
            if ((bool) call_user_func($this->predicate, $value, $key)) {
                yield $key => $value;
            }
        }
    }

}
