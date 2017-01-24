<?php

namespace Druid\Query\Component;

interface PagingIdentifierInterface
{
    /**
     * @param array $identifier
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset);

    /**
     * @return int
     */
    public function getOffset();
}
