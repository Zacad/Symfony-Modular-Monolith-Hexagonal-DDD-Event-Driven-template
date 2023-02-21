<?php

namespace App\Common\Bus\Event;

interface EventBusInterface
{
    public function dispatch(AbstractEvent $event): void;
}