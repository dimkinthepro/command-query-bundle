<?php

declare(strict_types=1);

namespace DimkinThePro\CommandQuery\Tests\Command\Fixtures;

use DimkinThePro\CommandQuery\Command\CommandHandlerInterface;

class CreateBookHandlerCommand implements CommandHandlerInterface
{
    public function __invoke(CreateBookCommand $command): Book
    {
        $book = new Book();
        $book->author = $command->author;
        $book->date = $command->date;

        return $book;
    }
}
