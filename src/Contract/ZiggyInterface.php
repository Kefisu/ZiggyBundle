<?php

namespace Kefisu\Bundle\ZiggyBundle\Contract;

use JsonSerializable;

interface ZiggyInterface
{
    public function toArray(): array;

    public function toJson(): string;
}