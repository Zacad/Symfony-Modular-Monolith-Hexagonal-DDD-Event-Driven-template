<?php

namespace App\FirstModule\Domain\Entity;

use App\FirstModule\Domain\ValueObject\Price;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class ExampleOne
{
    #[Column(type: 'integer')]
    private string $priceAmount;
        #[Column(type: 'string')]
        private string $priceCurrency;

    public function __construct(
        #[Id]
        #[Column(type: 'uuid')]
        private UuidInterface $id,
        #[Column(type: 'string')]
        private string $name,
        Price $price,

    )
    {
        $this->priceAmount = $price->pennyAmount();
        $this->priceCurrency = $price->currency();
    }

    public function price(): Price
    {
        return Price::fromPennyAmount($this->priceAmount, $this->priceCurrency);
    }

}