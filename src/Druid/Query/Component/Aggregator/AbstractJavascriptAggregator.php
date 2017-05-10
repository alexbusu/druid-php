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

use JMS\Serializer\Annotation as Serializer;
use Druid\Query\Component\AbstractTypedComponent;

abstract class AbstractJavascriptAggregator extends AbstractTypedComponent
{
    /**
     * @var array
     * @Serializer\SerializedName(value="fieldNames")
     */
    private $fieldName;

    private $name;
    
    /**
     * @var string
     */
    private $fnAggregate = 'function(current) {return current}';
    private $fnCombine = "function(a, b) { return a + b; }";
    private $fnReset = "function() { return 0; }";

    /**
     * AbstractJavascriptAggregator constructor.
     *
     * @param string $type
     * @param string $name
     * @param array  $fieldNames
     * @param array  $cpc
     */
    public function __construct($type, $name, array $fieldNames, array $functions)
    {
        parent::__construct($type);
        $this->fieldName = $fieldNames;
        $this->name = $name;
        $this->fnAggregate = $functions['fnAggregate'];
        $this->fnCombine = $functions['fnCombine'];
        $this->fnReset = $functions['fnReset'];
    }


    public function __sleep()
    {
        return ['fieldName', 'fnAddnotation', 'fnCombine', 'fnReset'];
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
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return String
     */
    public function getFnAggregate()
    {
        return $this->fnAggregate;
    }

    /**
     * @return String
     */
    public function getFnCombine()
    {
        return $this->fnCombine;
    }

    /**
     * @return String
     */
    public function getFnReset()
    {
        return $this->fnReset;
    }
}
