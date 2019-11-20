<?php

namespace Luggsoft\Php\Common\Collections\Enumerators;

use Luggsoft\Php\Common\Collections\CollectionInterface;
use Luggsoft\Php\Common\Collections\EnumeratorBase;
use Luggsoft\Php\Common\Collections\EnumeratorFactory;
use Luggsoft\Php\Common\Collections\EnumeratorFactoryInterface;

class SkipEnumerator extends EnumeratorBase
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
        return new EnumeratorFactory('skip', function (int $count) {
            return new SkipEnumerator($count);
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
                continue;
            }
            yield $key => $value;
        }
    }
    
}
