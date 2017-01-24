<?php

namespace Druid\Query\Select;

use Druid\Query\Exception\RequiredArgumentException;

class Select extends AbstractSelectQuery
{

    /**
     * Performs query validation
     * @throws RequiredArgumentException
     */
    public function validate()
    {
        if (!$this->getDataSource()) {
            throw new RequiredArgumentException('\'dataSource\' is a required parameter');
        }
        if (!$this->getIntervals()) {
            throw new RequiredArgumentException('\'intervals\' is a required parameter');
        }
        if (!$this->getGranularity()) {
            throw new RequiredArgumentException('\'granularity\' is a required parameter');
        }
        if (!$this->getPagingSpec()) {
            throw new RequiredArgumentException('\'pagingSpec\' is a required parameter');
        }
    }
}
