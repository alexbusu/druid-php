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

namespace Druid\Tests\QueryBuilder;

use Druid\Query\Component\ComponentInterface;
use Druid\Query\Component\DimensionSpec\DefaultDimensionSpec;
use Druid\Query\Component\PagingSpec\PagingIdentifier;
use Druid\Query\Component\PagingSpec\PagingSpec;
use Druid\QueryBuilder\SelectQueryBuilder;

class SelectQueryBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFailAddComponent()
    {
        $builder = new SelectQueryBuilder();
        $component = $this->createMock(ComponentInterface::class);
        $builder->addComponent('not_exists_component', $component);
    }

    public function testSettersAndGetters()
    {
        $builder = new SelectQueryBuilder();

        $now = new \DateTime();
        $pagingSpec = new PagingSpec(new PagingIdentifier(), 10, PagingSpec::IDENTIFIER_FROM_NEXT);
        $builder
            ->setDataSource('data-source')
            ->addInterval($now, new \DateTime())
            ->setDescending(true)
            ->setFilter($builder->filter()->selectorFilter('gender', 'male'))
            ->setDimensions(['dim1', new DefaultDimensionSpec('dim2', 'alias')])
            ->setMetrics(['clicks', 'visits'])
            ->setPagingSpec($pagingSpec);

        $query = $builder->getQuery();

        $this->assertEquals('data-source', $query->getDataSource()->getName());
        $this->assertEquals($now->format(DATE_ISO8601), $query->getIntervals()[0]->getStart());
        $this->assertEquals('gender', $query->getFilter()->getDimension());
        $this->assertEquals('male', $query->getFilter()->getValue());
        $this->assertEquals('dim1', $query->getDimensions()[0]);
        $this->assertInstanceOf(DefaultDimensionSpec::class, $query->getDimensions()[1]);
        $this->assertTrue($query->getDescending()->isDescending());
        $this->assertEquals('clicks', $query->getMetrics()[0]);
        $this->assertInstanceOf(PagingSpec::class, $query->getPagingSpec());
    }
}
