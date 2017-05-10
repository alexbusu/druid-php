<?php

namespace Druid\Query\Component\DimensionSpec\ExtractionFunctions;

use Druid\Query\Component\AbstractTypedComponent;
use Druid\Query\Component\ExtractionFunctionInterface;
use Druid\Query\Component\Granularity\SimpleGranularity;
use Druid\Query\Component\GranularityInterface;

class TimeFormatExtractionFunction extends AbstractTypedComponent implements ExtractionFunctionInterface
{

    /**
     * Date time format for the resulting dimension value, in Joda Time DateTimeFormat,
     * or null to use the default ISO8601 format
     * @link http://www.joda.org/joda-time/apidocs/org/joda/time/format/DateTimeFormat.html
     * @var string
     */
    private $format;

    /**
     * Locale (language and country) to use, given as a IETF BCP 47 language tag, e.g. en-US, en-GB, fr-FR
     * @link http://www.oracle.com/technetwork/java/javase/java8locales-2095355.html#util-text
     * @var string
     */
    private $locale;

    /**
     * Time zone to use in IANA tz database format, e.g. Europe/Berlin
     * (this can possibly be different than the aggregation time-zone)
     *
     * @var string
     */
    private $timeZone;

    /**
     * @var GranularityInterface
     */
    private $granularity;

    /**
     * TimeFormatExtractionFunction constructor.
     * @param string $format
     * @param string $locale
     * @param string $timezone
     * @param string|GranularityInterface $granularity
     */
    public function __construct($format = null, $locale = null, $timezone = null, $granularity = null)
    {
        parent::__construct(self::TYPE_TIME_FORMAT);
        $this->format = $format;
        $this->locale = $locale;
        $this->timeZone = $timezone;
        if ($granularity) {
            $this->granularity = $granularity instanceof GranularityInterface
                ? $granularity : new SimpleGranularity((string)$granularity);
        }
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * @return GranularityInterface
     */
    public function getGranularity()
    {
        return $this->granularity;
    }
}
