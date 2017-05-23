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

namespace Druid\Query\Component\Filter;

use Druid\Query\Component\AbstractTypedComponent;
use Druid\Query\Component\FilterInterface;

/**
 * Class BoundFilter.
 */
class BoundFilter extends AbstractTypedComponent implements FilterInterface
{
    /**
     * @var string
     */
    private $dimension;

    /**
     * @var String
     */
    private $lower;

    /**
     * @var String
     */
    private $upper;

    /**
     * @var Boolean
     */
    private $lowerStrict;

    /**
     * @var Boolean
     */
    private $upperStrict;
    
    /**
     * @var String
     */
    private $ordering;
    
    /**
     * @var ExtractionFunctionInterface
     */
    private $extractionFn;
    
    const LEXICOGRAPHIC = 'lexicographic';
    const STRLEN = 'strlen';
    const ALPHANUMERIC = 'alphanumeric';
    const NUMERIC = 'numeric';
    
    
    /**
    * BoundFilter constructor.
    * 
    * @param mixed $dimension
    * @param mixed $lower
    * @param mixed $upper
    * @param mixed $lowerStrict
    * @param mixed $upperStrict
    */
    public function __construct($dimension, $lower = null, $upper = null, $lowerStrict = false, $upperStrict = false, $ordering = self::LEXICOGRAPHIC, ExtractionFunctionInterface $extractionFunction = null)
    {
        parent::__construct(FilterInterface::TYPE_BOUND);
        $this->dimension = $dimension;
        $this->lower = $lower;
        $this->upper = $upper;
        $this->lowerStrict = $lowerStrict;
        $this->upperStrict = $upperStrict;
        $this->extractionFn = $extractionFunction;
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
    public function getLower()
    {
        return $this->lower;
    }
    
    /**
     * @return string
     */
    public function getUpper()
    {
        return $this->upper;
    }

    /**
     * @return boolean
     */
    public function getLowerStrict()
    {
        return $this->lowerStrict;
    }

    /**
     * @return boolean
     */
    public function getUpperStrict()
    {
        return $this->upperStrict;
    }
    
    /**
     * @return ExtractionFunctionInterface
     */
    public function getExtractionFn()
    {
        return $this->extractionFn;
    }
    
}
