<?php

namespace App\Repository\Destination;

use App\Entity\Destination;
use Faker\Factory;

class FakedDestinationRepository implements DestinationRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id): Destination
    {
        // DO NOT MODIFY THIS METHOD
        $generator    = Factory::create();
        $generator->seed($id);

        return new Destination(
            $id,
            $generator->country,
            'en',
            $generator->slug()
        );
    }
}
