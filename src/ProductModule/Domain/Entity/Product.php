<?php

namespace App\ProductModule\Domain\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class Product
{
    #[Id]
    #[Column(type: 'uuid')]
    private UuidInterface $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $sku;

    #[Column(type: 'string', nullable: false)]
    private string $name;

    public function __construct(
        UuidInterface $id,
        string $sku,
        string $name,
    ) {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSku()
    {
        return $this->sku;
    }

}