<?php

require __DIR__.'/../src/Bondi.php';
require __DIR__.'/../src/Middleware.php';
require __DIR__.'/../src/BondiMiddleware.php';

require __DIR__ . '/../src/Handler/Handler.php';
require __DIR__ . '/../src/Handler/HandlerResolver.php';
require __DIR__ . '/../src/Handler/StandardResolver.php';

// Rent Command & Handler
class RentCommand {

    private $movie = "back to the future";

    public function getMovie()
    {
        return $this->movie;
    }
}

class RentCommandHandler implements \Bondi\Handler\Handler{

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        return $command->getMovie();
    }
}

// Middleware
class DeliveryMiddleware
{
    /**
     * @param $command
     * @param callable $next
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $movie = $next($command);

        print("Delivering: $movie");

        return $movie;
    }
}

$handlerResolver = new \Bondi\Handler\StandardResolver();
$handlerResolver->registerHandler(new RentCommandHandler(), RentCommand::class);
$handlerMiddleware = new \Bondi\BondiMiddleware($handlerResolver);

$bondi = new \Bondi\Bondi([new DeliveryMiddleware(), $handlerMiddleware]);
$bondi->execute(new RentCommand());


