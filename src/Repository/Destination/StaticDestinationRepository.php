<?php

namespace App\Repository\Destination;

use App\Entity\Destination\DestinationInterface;

class StaticDestinationRepository implements DestinationRepositoryInterface
{
    /**
     * @var DestinationInterface
     */
    private $destination;

    public function __construct(DestinationInterface $staticDestination) {
        $this->destination = $staticDestination;
    }

    public function getById($id): DestinationInterface {
        return $this->destination;
    }
}