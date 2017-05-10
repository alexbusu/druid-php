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

abstract class AbstractJavascriptAggregator extends AbstractArithmeticalAggregator
{
    /**
     * @var array
     * @Serializer\SerializedName(value="fieldNames")
     */
    private $fieldName;

    /**
     * @var string
     */
    private $fnAggregate = '';

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
    public function __construct($type, $name, array $fieldNames, array $cpc)
    {
        parent::__construct($type, $name, $fieldNames);
        $this->fieldName = $fieldNames;
        $cpcs = "[";
        foreach ($cpc as $key => $value) {
            $cpcs .= "'" . $key . "': " . $value . ",";
        }
        $cpcs = rtrim($cpcs, ",");
        $cpcs .= "]";
        $this->fnAggregate = "function(current, c, i, t) {var iac = $cpcs; var dateObj = new Date(t); " .
            "var month = dateObj.getUTCMonth() + 1; var day = dateObj.getUTCDate(); " .
            "var year = dateObj.getUTCFullYear(); " .
            "return current + iac[i + '-' + year + '-' + month + '-' + day] || c);}";
    }


    public function __sleep()
    {
        return ['fieldName', 'fnAddnotation', 'fnCombine', 'fnReset'];
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return parent::getFieldName();
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
