<?php

namespace Bondi\Handler;

/**
 * Interface HandlerResolver
 * @package Bondi\Handler
 */
interface HandlerResolver
{
    public function resolveHandler(string $command) : Handler;
}