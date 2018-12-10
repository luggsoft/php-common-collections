<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;
use CrystalCode\Php\Common\Collections\EnumeratorFactory;
use CrystalCode\Php\Common\Collections\EnumeratorFactoryInterface;

class TakeEnumerator extends EnumeratorBase
{

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
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        $count = $this->count;
        foreach ($collection as $key => $value) {
            if ($count -- > 0) {
                yield $key => $value;
            }
            else {
                break;
            }
        }
    }

}
