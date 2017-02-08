<?php

namespace Druid\Driver;

use Druid\Driver\Guzzle\AbstractAsyncPromise;
use Druid\Query\QueryInterface;
use GuzzleHttp\Promise\PromiseInterface;

class ValidateConnectionDecorator implements DriverConnectionInterface
{

    /** @var DriverConnectionInterface */
    private $decoratedConnection;

    /**
     * ValidateConnectionDecorator constructor.
     * @param DriverConnectionInterface $connection
     */
    public function __construct(DriverConnectionInterface $connection)
    {
        $this->decoratedConnection = $connection;
    }

    /**
     * @param QueryInterface $query
     *
     * @return ResponseInterface
     */
    public function send(QueryInterface $query)
    {
        $query->validate();
        return $this->decoratedConnection->send($query);
    }

    /**
     * @param QueryInterface $query
     * @param AbstractAsyncPromise $promiseCallback
     *
     * @return PromiseInterface
     */
    public function sendAsync(QueryInterface $query, AbstractAsyncPromise $promiseCallback)
    {
        $query->validate();
        return $this->decoratedConnection->sendAsync($query, $promiseCallback);
    }
}
