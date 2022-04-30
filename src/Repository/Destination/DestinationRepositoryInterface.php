<?php

namespace App\Repository\Destination;

use App\Entity\Destination\DestinationInterface;

interface DestinationRepositoryInterface
{
    public function getById($id): DestinationInterface;
}