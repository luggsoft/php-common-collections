<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class TakeEnumerator extends EnumeratorBase
{
    
    /**
     *
     * @var int
     */
    private $count;
    
    /**
     *
     * @param int $count
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }
    
    /**
     *
     * @return EnumeratorFactoryInterface
     */
    public static function getEnumeratorFactory(): EnumeratorFactoryInterface
    {
        return new EnumeratorFactory('take', function (int $count) {
            return new TakeEnumerator($count);
        });
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        $count = $this->count;
        foreach ($collection as $key => $value) {
            if ($count-- > 0) {
                yield $key => $value;
            }
            else {
                break;
            }
        }
    }
    
}
