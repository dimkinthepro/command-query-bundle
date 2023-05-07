<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Command;

interface CommandBusInterface
{
    public function execute(CommandInterface $command): mixed;
}
