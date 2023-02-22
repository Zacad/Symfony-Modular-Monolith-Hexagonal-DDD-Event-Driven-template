<?php

namespace App\PricingModule\Domain\Entity;

use App\Common\ValueObject\Money;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class Price
{
    #[Column(type: 'uuid')]
    #[Id]
    private UuidInterface $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $sku;

    #[Column(type: 'integer', nullable: false)]
    private int $priceAmount;

    #[Column(type: 'string', nullable: false)]
    private string $priceCurrency;

    #[Column(type: 'string', nullable: false)]
    private string $priceList;

    public function __construct(
        UuidInterface $id,
        string $sku,
        string $priceList,
        Money $price,
    ) {
        if ($price->getPennyAmount() <= 0) {
            throw new \InvalidArgumentException('Price must be greater than 0');
        }

        $this->id = $id;
        $this->sku = $sku;
        $this->priceAmount = $price->getPennyAmount();
        $this->priceCurrency = $price->getCurrency();
        $this->priceList = $priceList;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return Money::fromPennyAmount($this->priceAmount, $this->priceCurrency);
    }


    /**
     * @return string
     */
    public function getPriceList(): string
    {
        return $this->priceList;
    }


}