<?php

namespace App\Common\Bus\Query;

interface QueryBusInterface
{
    public function query(AbstractQuery $query): mixed;
}