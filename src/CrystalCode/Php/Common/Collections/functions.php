<?php

namespace CrystalCode\Php\Common\Collections;

/**
 *
 * @param mixed $args
 * @return Collection
 */
function collect(...$args)
{
    return Collection::create($args);
}
