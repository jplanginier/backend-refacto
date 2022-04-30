<?php

namespace App\Repository\Destination;

use App\Entity\Destination\Destination;
use App\Entity\Destination\DestinationInterface;
use Faker\Factory;

class FakedDestinationRepository implements DestinationRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id): DestinationInterface {
        // DO NOT MODIFY THIS METHOD
        $generator = Factory::create();
        $generator->seed($id);

        return new Destination(
            $id,
            $generator->country,
            'en',
            $generator->slug()
        );
    }
}
