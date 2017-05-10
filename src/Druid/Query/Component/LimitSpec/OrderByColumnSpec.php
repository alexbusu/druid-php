<?php

namespace Druid\Query\Component\LimitSpec;

use Druid\Query\Component\SortInterface;

class OrderByColumnSpec
{
    const SORT_ASC = 'ascending';
    const SORT_DESC = 'descending';

    /** @var string Any dimension or metric name */
    private $dimension;

    /** @var string <"ascending"|"descending"> */
    private $direction;

    /** @var string One of \Druid\Query\Component\SortInterface::SORT_* */
    private $dimensionOrder;

    /**
     * The default order-by is ascending with lexicographic sorting
     * @param string $dimension
     * @param string $direction
     * @param string $dimensionOrder
     */
    public function __construct($dimension, $direction = null, $dimensionOrder = null)
    {
        is_null($direction) && ($direction = self::SORT_ASC);
        is_null($dimensionOrder) && ($dimensionOrder = SortInterface::SORT_LEXICOGRAPHIC);
        $this->dimension = (string)$dimension;
        $this->direction = $direction;
        $this->dimensionOrder = $dimensionOrder;
    }

    /**
     * @return string
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getDimensionOrder()
    {
        return $this->dimensionOrder;
    }
}
