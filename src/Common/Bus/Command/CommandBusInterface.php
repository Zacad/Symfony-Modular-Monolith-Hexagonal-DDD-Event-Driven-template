<?php

namespace App\Common\Bus\Command;

interface CommandBusInterface
{
    public function execute(AbstractCommand $command): void;
}