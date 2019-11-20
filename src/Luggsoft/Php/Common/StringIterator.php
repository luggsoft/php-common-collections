<?php

namespace Luggsoft\Php\Common;

use Iterator;

final class StringIterator implements Iterator
{
    
    /**
     *
     * @var string
     */
    private $value;
    
    /**
     *
     * @var int
     */
    private $index;
    
    /**
     *
     * @param string $value
     * @param int $index
     */
    public function __construct(string $value, int $index = 0)
    {
        $this->value = $value;
        $this->index = $index;
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->value[$this->index];
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function next()
    {
        $this->index = $this->index + 1;
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->index;
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->value[$this->index]);
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->index = 0;
    }
    
}
