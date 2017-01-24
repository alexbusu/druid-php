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

namespace Druid\Query\Select;

use Druid\Query\AbstractQuery;
use Druid\Query\Component\Collection\CollectionComponent;
use Druid\Query\Component\DataSourceInterface;
use Druid\Query\Component\Descending\Descending;
use Druid\Query\Component\DimensionSpecInterface;
use Druid\Query\Component\FilterInterface;
use Druid\Query\Component\IntervalInterface;
use Druid\Query\Component\PagingSpecInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class AbstractSelectQuery.
 */
abstract class AbstractSelectQuery extends AbstractQuery
{
    /**
     * @var DataSourceInterface
     */
    private $dataSource;

    /**
     * @var array|IntervalInterface[]
     * @Serializer\Type("array<string>")
     */
    private $intervals;

    /**
     * @var Descending
     */
    private $descending;

    /**
     * @var FilterInterface
     */
    private $filter;

    /**
     * @var DimensionSpecInterface[]|CollectionComponent
     * @Serializer\Type("array")
     */
    private $dimensions = [];

    /**
     * @var string[]|CollectionComponent
     * @Serializer\Type("array<string>")
     */
    private $metrics = [];

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $granularity = 'all';

    /**
     * @var PagingSpecInterface
     * @Serializer\Accessor(getter="getSerializerPagingSpec")
     */
    private $pagingSpec;

    public function __construct()
    {
        parent::__construct(self::TYPE_SELECT);
    }

    /**
     * @return DataSourceInterface
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param DataSourceInterface $dataSource
     *
     * @return $this
     */
    public function setDataSource(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * @return array|\Druid\Query\Component\IntervalInterface[]
     */
    public function getIntervals()
    {
        return $this->intervals;
    }

    /**
     * @param array|\Druid\Query\Component\IntervalInterface[] $intervals
     *
     * @return $this
     */
    public function setIntervals(array $intervals)
    {
        $this->intervals = $intervals;

        return $this;
    }

    /**
     * @return FilterInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return $this
     */
    public function setFilter(FilterInterface $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param Descending $descending
     * @return $this
     */
    public function setDescending(Descending $descending)
    {
        $this->descending = $descending;
        return $this;
    }

    /**
     * @return Descending
     */
    public function getDescending()
    {
        return $this->descending;
    }

    /**
     * @param array|CollectionComponent $dimensions
     * @return $this
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions =
            $dimensions instanceof CollectionComponent
                ? $dimensions
                : new CollectionComponent($dimensions);
        return $this;
    }

    /**
     * @return CollectionComponent
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param array|CollectionComponent $metrics
     * @return $this
     */
    public function setMetrics($metrics)
    {
        $this->metrics =
            $metrics instanceof CollectionComponent
                ? $metrics
                : new CollectionComponent($metrics);
        return $this;
    }

    /**
     * @return CollectionComponent
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * @param PagingSpecInterface $pagingSpec
     * @return $this
     */
    public function setPagingSpec(PagingSpecInterface $pagingSpec)
    {
        $this->pagingSpec = $pagingSpec;
        return $this;
    }

    /**
     * @return PagingSpecInterface
     */
    public function getPagingSpec()
    {
        return $this->pagingSpec;
    }

    public function getSerializerPagingSpec()
    {
        return $this->pagingSpec;
    }

    /**
     * @return \string
     */
    public function getGranularity()
    {
        return $this->granularity;
    }
}
