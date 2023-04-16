<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Tests\Command\Fixtures;

use DimkinThePro\CommandQuery\Command\CommandInterface;

class CreateBookCommand implements CommandInterface
{
    public function __construct(
        public readonly string $author,
        public readonly \DateTimeImmutable $date
    ) {
    }
}
