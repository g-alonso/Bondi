<?php

namespace Bondi;
use Bondi\Handler\HandlerResolver;

/**
 * Class BondiMiddleware
 * @package Bondi
 */
class BondiMiddleware implements Middleware
{
    /**
     * @var HandlerResolver
     */
    private $handlerResolver;

    /**
     * Bondi constructor.
     * @param HandlerResolver $handlerResolver
     */
    public function __construct(HandlerResolver $handlerResolver)
    {
        $this->handlerResolver = $handlerResolver;
    }

    /**
     * @param $command
     * @throws \Exception
     */
    public function execute($command, callable $next)
    {
        $handler = $this->handlerResolver->resolveHandler(get_class($command));
        return $handler->handle($command);
    }
}