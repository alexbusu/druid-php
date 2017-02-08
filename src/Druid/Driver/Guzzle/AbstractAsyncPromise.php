<?php

namespace Druid\Driver\Guzzle;

abstract class AbstractAsyncPromise
{
    /**
     * @param \GuzzleHttp\Psr7\Response $response
     */
    abstract public function onSuccess(\GuzzleHttp\Psr7\Response $response);

    /**
     * @param \RuntimeException $response
     */
    abstract public function onFailure(\RuntimeException $response);
}
