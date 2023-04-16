# Command and query library for Symfony

## 1. Installation:
```bash
composer require dimkinthepro/command-query-bundle
```

### update "config/bundles.php"
```php
<?php

return [
#...
    DimkinThePro\CommandQuery\CommandQueryBundle::class => ['all' => true],
];
```

### update "config/services.yaml"
```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true
    
  #...
    _instanceof:
        DimkinThePro\CommandQuery\Query\QueryHandlerInterface:
            tags:
                - { name: messenger.message_handler, bus: query_bus }

        DimkinThePro\CommandQuery\Command\CommandHandlerInterface:
            tags:
                - { name: messenger.message_handler, bus: command_bus }
  #...
```

### update "config/packages/messenger.yaml":

```yaml
framework:
    messenger:
        default_bus: query_bus
        buses:
            query_bus:
            command_bus:
                middleware:
                    - doctrine_transaction
#...
```

## 2. Usage example:
1.Create command
```php
# src/Command/CreateBook/CreateBookCommand.php
<?php

declare(strict_types=1);

namespace App\Command\CreateBook;

use DimkinThePro\CommandQuery\Command\CommandInterface;

class CreateBookCommand implements CommandInterface
{
    public function __construct(
        public readonly string $author,
        public readonly \DateTimeImmutable $year
    ) {
    }
}
```

2. Create handler
```php
# src/Command/CreateBook/CreateBookCommandHandler.php
<?php

declare(strict_types=1);

namespace App\Command\CreateBook;

use App\Domain\Entity\Book;
use App\Domain\Repository\BookRepositoryInterface;
use DimkinThePro\CommandQuery\Command\CommandHandlerInterface;

class CreateBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly BookRepositoryInterface $bookRepository
    ) {
    }

    public function __invoke(CreateBookCommand $command): Book
    {
        $book = new Book();
        $book->setAuthor = $command->author
        $book->setYear = $command->year
        
        $this->bookRepository->add($book);

        return $book;
    }
}
```
