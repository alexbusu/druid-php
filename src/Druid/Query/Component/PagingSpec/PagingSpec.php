<?php

namespace Druid\Query\Component\PagingSpec;

use Druid\Query\Component\PagingIdentifierInterface;
use Druid\Query\Component\PagingSpecInterface;
use JMS\Serializer\Annotation as Serializer;

class PagingSpec implements PagingSpecInterface
{
    /**
     * @var array
     * @Serializer\Type("array<string, integer>")
     * @Serializer\Accessor(getter="getSerializerIdentifier")
     */
    private $pagingIdentifiers;

    /**
     * @var int
     */
    private $threshold;

    /**
     * @var bool
     */
    private $fromNext;

    public function __construct(
        PagingIdentifierInterface $pagingIdentifiers,
        $threshold,
        $fromNext = self::IDENTIFIER_FROM_CURRENT
    ) {
        $this->setPagingIdentifier($pagingIdentifiers);
        $this->setThreshold($threshold);
        $this->setFromNext($fromNext);
    }

    /**
     * @param PagingIdentifierInterface $pagingIdentifiers
     * @return $this
     */
    public function setPagingIdentifier(PagingIdentifierInterface $pagingIdentifiers)
    {
        $this->pagingIdentifiers = $pagingIdentifiers;
    }

    /**
     * @return PagingIdentifierInterface
     */
    public function getPagingIdentifier()
    {
        return $this->pagingIdentifiers;
    }

    /**
     * @param int $threshold
     * @return $this
     */
    public function setThreshold($threshold)
    {
        $this->threshold = (int)$threshold;
    }

    /**
     * @return int
     */
    public function getThreshold()
    {
        return (int)$this->threshold;
    }

    /**
     * Setting to true, the returned pagingIdentifiers property will already contain
     * the values for the next page (no need to increase/decrease the offset)
     * @param bool $fromNext
     * @return $this
     */
    public function setFromNext($fromNext)
    {
        $this->fromNext = (bool)$fromNext;
    }

    /**
     * @return bool
     */
    public function isFromNext()
    {
        return $this->fromNext;
    }

    /**
     * @return array
     */
    public function getSerializerIdentifier()
    {
        if (($identifier = $this->getPagingIdentifier()->getIdentifier())) {
            return [
                $identifier => $this->getPagingIdentifier()->getOffset()
            ];
        }
        return [];
    }
}
