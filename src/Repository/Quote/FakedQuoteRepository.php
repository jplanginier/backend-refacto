<?php

namespace App\Repository\Quote;

use App\Entity\Quote\Quote;
use App\Entity\Quote\QuoteInterface;
use DateTime;
use Faker\Factory;

class FakedQuoteRepository implements QuoteRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id): QuoteInterface {
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
