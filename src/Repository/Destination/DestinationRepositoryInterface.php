<?php

namespace App\Repository\Destination;

use App\Entity\Destination;

interface DestinationRepositoryInterface
{
    public function getById($id): Destination;
}