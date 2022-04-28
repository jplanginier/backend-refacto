<?php

namespace App\Repository\Destination;

use App\Entity\Destination;

class StaticDestinationRepository implements DestinationRepositoryInterface
{
    /**
     * @var Destination
     */
    private $destination;

    public function __construct(Destination $staticDestination) {
        $this->destination = $staticDestination;
    }

    public function getById($id): Destination {
        return $this->destination;
    }
}