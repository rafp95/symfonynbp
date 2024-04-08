<?php

namespace App\Infrastructure\Bus;

use App\Application\Command\CommandInterface;

class CommandBus implements CommandBusInterface
{
    private array $handlers = [];

    public function registerHandler(string $commandClassName, $handler): void
    {
        $this->handlers[$commandClassName] = $handler;
    }

    public function handle(CommandInterface $command): void
    {
        $commandClassName = get_class($command);

        if (!isset($this->handlers[$commandClassName])) {
            throw new \RuntimeException('No handler registered for ' . $commandClassName);
        }

        $this->handlers[$commandClassName]($command);
    }

}