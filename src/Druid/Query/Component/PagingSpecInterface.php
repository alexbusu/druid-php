<?php

namespace Druid\Query\Component;

/**
 * Interface PagingSpecInterface
 * @package Druid\Query\Component
 */
interface PagingSpecInterface extends ComponentInterface
{
    const IDENTIFIER_FROM_NEXT = true;
    const IDENTIFIER_FROM_CURRENT = false;

    /**
     * @param PagingIdentifierInterface $pagingIdentifiers
     * @return $this
     */
    public function setPagingIdentifier(PagingIdentifierInterface $pagingIdentifiers);

    /**
     * @return PagingIdentifierInterface
     */
    public function getPagingIdentifier();

    /**
     * @param int $threshold
     * @return $this
     */
    public function setThreshold($threshold);

    /**
     * @return int
     */
    public function getThreshold();

    /**
     * Setting to true, the returned pagingIdentifiers property will already contain
     * the values for the next page (no need to increase/decrease the offset)
     * @param bool $fromNext
     * @return $this
     */
    public function setFromNext($fromNext);

    /**
     * @return bool
     */
    public function isFromNext();
}
