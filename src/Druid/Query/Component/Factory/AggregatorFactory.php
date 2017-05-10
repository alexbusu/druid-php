<?php

/*
 * Copyright (c) 2016 PIXEL FEDERATION, s.r.o.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the PIXEL FEDERATION, s.r.o. nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL PIXEL FEDERATION, s.r.o. BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace Druid\Query\Component\Factory;

use Druid\Query\Component\Aggregator;
use Druid\Query\Component\AggregatorInterface;
use Druid\Query\Component\FilterInterface;

/**
 * Class AggregatorFactory.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AggregatorFactory
{
    /**
     * @param string $name
     *
     * @return Aggregator\CountAggregator
     */
    public function count($name)
    {
        return new Aggregator\CountAggregator($name);
    }

    /**
     * @param string $name
     * @param string $fieldName
     *
     * @return Aggregator\HyperUniqueAggregator
     */
    public function hyperUnique($name, $fieldName)
    {
        return new Aggregator\HyperUniqueAggregator($name, $fieldName);
    }

    /**
     * @param string $name
     * @param string $fieldName
     *
     * @return Aggregator\DoubleSumAggregator
     */
    public function doubleSum($name, $fieldName)
    {
        return new Aggregator\DoubleSumAggregator($name, $fieldName);
    }

    /**
     * @param string $name
     * @param string $fieldName
     *
     * @return Aggregator\LongSumAggregator
     */
    public function longSum($name, $fieldName)
    {
        return new Aggregator\LongSumAggregator($name, $fieldName);
    }

    /**
     * @param FilterInterface     $filter
     * @param AggregatorInterface $aggregator
     *
     * @return Aggregator\FilteredAggregator
     */
    public function filtered(FilterInterface $filter, AggregatorInterface $aggregator)
    {
        return new Aggregator\FilteredAggregator($filter, $aggregator);
    }

    /**
     * @param string       $type
     * @param string       $name
     * @param string|array $fieldName
     * @param array        $data
     * @return AggregatorInterface
     */
    public function arithmeticAggregator($type, $name, $fieldName, array $data = [])
    {
        switch ($type) {
            case AggregatorInterface::TYPE_COUNT:
                return $this->count($name);
            case AggregatorInterface::TYPE_DOUBLE_SUM:
                return $this->doubleSum($name, $fieldName);
            case AggregatorInterface::TYPE_HYPER_UNIQUE:
                return $this->hyperUnique($name, $fieldName);
            case AggregatorInterface::TYPE_LONG_SUM:
                return $this->longSum($name, $fieldName);
            case AggregatorInterface::TYPE_CURRENCY_SUM:
                return $this->currencySum($name, $fieldName, $data);
            case AggregatorInterface::TYPE_JAVASCRIPT_SUM:
                return $this->javascriptSum($name, $fieldName, $data);
            default:
                throw new \RuntimeException(
                    sprintf('Invalid aggregator type %s', $type)
                );
        }
    }

    /**
     * @param string $name
     * @param string $fieldName
     * @param array  $conversions
     * @return Aggregator\CurrencySumAggregator
     */
    public function currencySum($name, $fieldName, array $conversions)
    {
        return new Aggregator\CurrencySumAggregator($name, $fieldName, $conversions);
    }

    /**
     * @param string $name
     * @param array  $fieldNames
     * @param array  $data
     * @return Aggregator\JavascriptSumAggregator
     */
    {
    }
}
