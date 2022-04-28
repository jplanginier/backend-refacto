<?php

namespace App\Repository\Quote;

use App\Entity\Quote;

class StaticQuoteRepository implements QuoteRepositoryInterface
{
    /**
     * @var Quote
     */
    private $quote;

    public function __construct(Quote $staticQuote) {
        $this->quote = $staticQuote;
    }

    public function getById($id): Quote {
        return $this->quote;
    }
}