<?php

namespace Druid\Query\Component\PagingSpec;

use Druid\Query\Component\PagingIdentifierInterface;

class PagingIdentifier implements PagingIdentifierInterface
{
    /** @var string */
    private $identifier;

    /** @var int */
    private $offset;

    /**
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = (int)$offset;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return (int)$this->offset;
    }
}
