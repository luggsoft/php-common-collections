<?php

namespace CrystalCode\Php\Common\Collections;

final class Aggregator extends AggregatorBase
{

    /**
     * 
     * {@inheritdoc}
     */
    public function __construct(callable $applicator, $initial = null)
    {
        parent::__construct($applicator, $initial);
    }

}
