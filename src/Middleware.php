<?php

namespace Bondi;

/**
 * Interface Middleware
 * @package Bondi
 */
interface Middleware
{
    public function execute($command, callable $next);
}