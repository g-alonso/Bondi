<?php

namespace Bondi;

/**
 * Class Bondi
 * @package Bondi
 */
class Bondi
{
    /**
     * @var \Closure
     */
    private $firstMiddleware = [];

    /**
     * Bondi constructor.
     * @param $middlewares
     */
    public function __construct($middlewares)
    {
        $this->firstMiddleware = $this->createMiddlewareChain($middlewares);
    }

    /**
     * @param $command
     */
    public function execute($command)
    {
        $middleware = $this->firstMiddleware;

        /** @var \Closure $middleware */
        return $middleware($command);
    }

    /**
     * @param $middlewares
     * @return \Closure
     */
    public function createMiddlewareChain($middlewares)
    {
        $queueNext = function(){

        };

        foreach (array_reverse($middlewares) as $middleware) {
            $queueNext = function ($command) use ($middleware, $queueNext) {
                return $middleware->execute($command, $queueNext);
            };
        }

        return $queueNext;
    }
}
