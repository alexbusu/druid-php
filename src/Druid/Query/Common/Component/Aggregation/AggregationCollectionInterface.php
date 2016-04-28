<?php
/**
 * @author    jhrncar
 * @copyright PIXEL FEDERATION
 * @license   Internal use only
 */

namespace Druid\Query\Common\Component\Aggregation;

use Druid\Query\Common\ComponentInterface;

interface AggregationCollectionInterface extends ComponentInterface
{

    /**
     * @return AggregatorInterface[]|array
     */
    public function getAggregations();
}
