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

namespace Druid\Query\Component\Aggregator;

use Druid\Query\Component\AbstractTypedComponent;

abstract class MetricOverriderAggregator extends AbstractTypedComponent
{
    private $name;
    private $overriddenMetric;
    private $multiplier;
    private $selectorName1;
    private $selectorName2;
    private $overriddenValuesInJson;
    private $granularityString;
    private $currencyRates;
    
    
    /**
     * AbstractArithmeticalAggregator constructor.
     *
     * @param string $type
     * @param string $name
     * @param string $fieldName
     * @param array  $conversions
     */
    public function __construct($type, $name, $overriddenMetric, $multiplier, $selectors, $overrides, $granularity)
    {
        parent::__construct($type);
        $this->name = $name; 
        $this->overriddenMetric  = $overriddenMetric; 
        $this->multiplier  = $multiplier; 
        $this->selectorName1  = $selectors[0]; 
        $this->selectorName2  =  $selectors[1];
        $this->overriddenValuesInJson  = $overrides[0];
        $this->currencyRates  = $overrides[1];
        $this->granularityString =  $granularity;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOverriddenMetric()
    {
        return $this->overriddenMetric;
    }

    /**
     * @return string
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }

    /**
     * @return string
     */
    public function getSelectorName1()
    {
        return $this->selectorName1;
    }
    
    /**
     * @return string
     */
    public function getSelectorName2()
    {
        return $this->selectorName2;
    }
    

    /**
     * @return array
     */
    public function getOverriddenValuesInJson()
    {
        return $this->overriddenValuesInJson;
    }
    
    /**
     * @return array
     */
    public function getCurrencyRates()
    {
        return $this->currencyRates;
    }    
}