<?php

namespace App\PricingModule\Application\CommandHandler;

use App\PricingModule\Application\Command\CreatePriceCommand;
use App\PricingModule\Domain\Entity\Price;
use App\PricingModule\Domain\Repository\PriceRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreatePriceCommandHandler
{
    public function __construct(
        private readonly PriceRepositoryInterface $priceRepository,
    ) {
    }

    public function __invoke(CreatePriceCommand $command): void
    {
        $price = new Price(
            $command->id,
            $command->sku,
            $command->priceList,
            $command->price,
        );
        $this->priceRepository->save($price);
    }
}