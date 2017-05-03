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

use Druid\Query\Component\Filter\InFilter;
use Druid\Query\Component\Filter\LogicalFilter;
use Druid\Query\Component\Filter\NotFilter;
use Druid\Query\Component\Filter\SelectorFilter;
use Druid\Query\Component\FilterInterface;

/**
 * Class FilterFactory.
 */
class FilterFactory
{
    /**
     * @param string $dimension
     * @param string $value
     *
     * @return SelectorFilter
     */
    public function selectorFilter($dimension, $value)
    {
        return new SelectorFilter($dimension, $value);
    }

    /**
     * @param array|FilterInterface[] $fields
     *
     * @return LogicalFilter
     */
    public function andFilter(array $fields)
    {
        return $this->logicalFilter(FilterInterface::TYPE_LOGICAL_AND, $fields);
    }

    /**
     * @param array|FilterInterface $fields
     *
     * @return LogicalFilter
     */
    public function orFilter(array $fields)
    {
        return $this->logicalFilter(FilterInterface::TYPE_LOGICAL_OR, $fields);
    }

    /**
     * @param string $type
     * @param array  $fields
     *
     * @return LogicalFilter
     */
    public function logicalFilter($type, array $fields)
    {
        return new LogicalFilter($type, $fields);
    }

    /**
     * @param FilterInterface $field
     *
     * @return NotFilter
     */
    public function notFilter(FilterInterface $field)
    {
        return new NotFilter($field);
    }

    /**
     * @param string $dimension
     * @param array $values
     *
     * @return InFilter
     */
    public function inFilter($dimension, array $values)
    {
        return new InFilter($dimension, $values);
    }
}
