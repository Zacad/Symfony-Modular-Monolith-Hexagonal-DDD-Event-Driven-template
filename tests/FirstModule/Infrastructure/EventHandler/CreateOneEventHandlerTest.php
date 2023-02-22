<?php

namespace App\Tests\ProductModule\Infrastructure\EventHandler;

use App\Common\Bus\Command\CommandBusInterface;
use App\ProductModule\Application\Command\CreateExampleOneCommand;
use Symfony\Component\Serializer\SerializerInterface;

class CreateOneEventHandlerTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel(
            [
                'environment' => 'test'
            ]
        );

        /**
         * @var \League\Flysystem\FilesystemOperator $flysystem
         */
        $flysystem = static::getContainer()->get('default.storage');
        $flysystem->deleteDirectory('example-one');
    }

    public function testItUpdateReadModel()
    {
        // given
        $command = new CreateExampleOneCommand(
            id: \Ramsey\Uuid\Uuid::uuid4(),
            name: 'Example one',
        );

        $commandBus = static::getContainer()->get('test.'.CommandBusInterface::class);
        $flysystem = static::getContainer()->get('default.storage');
        $serializer = static::getContainer()->get(SerializerInterface::class);

        // when
        $commandBus->execute($command);

        $view = $flysystem->read('example-one/'.$command->id->toString().'.json');

        // then

        $view = json_decode($view, true);
        $this->assertSame($command->id->toString(), $view['id']);
        $this->assertSame($command->name, $view['name']);
    }
}