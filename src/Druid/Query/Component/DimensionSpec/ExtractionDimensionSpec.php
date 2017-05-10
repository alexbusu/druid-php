<?php

namespace Druid\Query\Component\DimensionSpec;

use Druid\Query\Component\AbstractTypedComponent;
use Druid\Query\Component\DimensionSpecInterface;
use Druid\Query\Component\ExtractionFunctionInterface;

/**
 * Class DefaultDimension.
 */
class ExtractionDimensionSpec extends AbstractTypedComponent implements DimensionSpecInterface
{
    /**
     * @var string
     */
    private $dimension;

    /**
     * @var string
     */
    private $outputName;

    /**
     * @var ExtractionFunctionInterface
     */
    private $extractionFn;

    /**
     * DefaultDimension constructor.
     *
     * @param string $dimension
     * @param string $outputName
     * @param ExtractionFunctionInterface $extractionFunction
     */
    public function __construct($dimension, $outputName, ExtractionFunctionInterface $extractionFunction)
    {
        $this->dimension = $dimension;
        $this->outputName = $outputName ?: $dimension;
        $this->extractionFn = $extractionFunction;
        parent::__construct(self::TYPE_EXTRACTION);
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
    public function getOutputName()
    {
        return $this->outputName;
    }

    /**
     * @return ExtractionFunctionInterface
     */
    public function getExtractionFn()
    {
        return $this->extractionFn;
    }
}
