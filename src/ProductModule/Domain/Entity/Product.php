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
    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'integer')]
    public function __construct(
        UuidInterface $id,
        string $name,
    ) {
        $this->id = $id;
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

}