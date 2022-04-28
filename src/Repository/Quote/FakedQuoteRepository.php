<?php

namespace App\Repository\Quote;

use App\Entity\Quote\Quote;
use App\Helper\SingletonTrait;
use DateTime;
use Faker\Factory;

class FakedQuoteRepository implements QuoteRepositoryInterface
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id) : Quote
    {
        // DO NOT MODIFY THIS METHOD
        $generator = Factory::create();
        $generator->seed($id);

        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            new DateTime()
        );
    }
}
