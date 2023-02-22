<?php

namespace App\ProductModule\Domain\Entity;

use App\ProductModule\Domain\ValueObject\Price;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class ExampleOne
{
    #[Id]
    #[Column(type: 'uuid')]
    private UuidInterface $id;
    #[Column(type: 'string')]
    private string $name;
    #[Column(type: 'integer')]
    private int $priceAmount;
    #[Column(type: 'string')]
    private string $priceCurrency;

    public function __construct(
        UuidInterface $id,
        string $name,
        Price $price,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->priceAmount = $price->getPennyAmount();
        $this->priceCurrency = $price->getCurrency();
    }


    public function getPrice(): Price
    {
        return Price::fromPennyAmount($this->priceAmount, $this->priceCurrency);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

}