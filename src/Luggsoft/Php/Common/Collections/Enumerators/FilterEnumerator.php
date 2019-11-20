<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class FilterEnumerator extends EnumeratorBase
{
    
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
