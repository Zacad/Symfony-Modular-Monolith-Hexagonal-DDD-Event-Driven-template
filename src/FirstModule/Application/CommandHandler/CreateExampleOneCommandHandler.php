<?php

namespace App\FirstModule\Application\CommandHandler;

use App\FirstModule\Application\Command\CreateExampleOneCommand;
use App\FirstModule\Domain\Entity\ExampleOne;
use App\FirstModule\Domain\Repository\ExampleOneRepositoryInterface;
use App\FirstModule\Domain\ValueObject\Price;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateExampleOneCommandHandler
{
    public function __construct(
        private readonly ExampleOneRepositoryInterface $exampleOneRepository,
    ) {
    }

    public function __invoke(CreateExampleOneCommand $command): void
    {
        try {
            $price = Price::fromMoney($command->price);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        $exampleOne = new ExampleOne(
            $command->id,
            $command->name,
            $price,
        );

        try {
            $this->exampleOneRepository->save($exampleOne);
        } catch (UniqueConstraintViolationException $e) {
            throw new \InvalidArgumentException('ExampleOne with this id already exists');
        }
    }
}