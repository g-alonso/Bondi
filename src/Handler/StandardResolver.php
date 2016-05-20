<?php

namespace Bondi\Handler;

/**
 * Class StandardResolver
 * @package Bondi\Handler
 */
class StandardResolver implements HandlerResolver
{

    private $registredHandlers = array();

    /**
     * @param Handler $handler
     * @param string $command
     */
    public function registerHandler(Handler $handler, string $command)
    {
        $this->registredHandlers[$command] = $handler;
    }

    /**
     * @param string $command
     * @return Handler
     * @throws \Exception
     */
    public function resolveHandler(string $command) : Handler
    {
        if (!isset($this->registredHandlers[$command])) {
            throw new \Exception("unable to resolve handler for command");
        }

        return $this->registredHandlers[$command];
    }
}