<?php

namespace App\Infrastructure\Bus;


use App\Application\Command\CommandInterface;

interface CommandBusInterface
{
    public function registerHandler(string $commandClassName, $handler): void;
    public function handle(CommandInterface $command): void;
}