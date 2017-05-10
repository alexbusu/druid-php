<?php

namespace Druid\Query\Component\DimensionSpec\ExtractionFunctions;

use Druid\Query\Component\AbstractTypedComponent;
use Druid\Query\Component\ExtractionFunctionInterface;

class SubstringExtractionFunction extends AbstractTypedComponent implements ExtractionFunctionInterface
{

    /** @var int */
    private $index;

    /** @var int */
    private $length;

    public function __construct($index = 0, $length = null)
    {
        parent::__construct(self::TYPE_SUBSTRING);
        $this->index = $index;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }
}
