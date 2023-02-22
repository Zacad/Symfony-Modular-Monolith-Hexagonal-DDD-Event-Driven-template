<?php

namespace App\ProductModule\ReadModel;

use App\ProductModule\Domain\Repository\ExampleOneRepositoryInterface;
use League\Flysystem\FilesystemOperator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExampleOneReadModel
{
    public function __construct(
        private readonly ExampleOneRepositoryInterface $exampleOneRepository,
        private readonly FilesystemOperator $defaultStorage,
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function update(UuidInterface $id): void
    {
        $exampleOne = $this->exampleOneRepository->findById($id);

        $json = $this->serializer->serialize($exampleOne, 'json');
        $this->defaultStorage->write('example-one/'.$id->toString().'.json', $json);
    }
}