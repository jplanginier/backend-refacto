<?php

namespace App\Repository\Quote;

use App\Entity\Quote\Quote;
use App\Entity\Quote\QuoteInterface;

class StaticQuoteRepository implements QuoteRepositoryInterface
{
    /**
     * @var QuoteInterface
     */
    private $quote;

    public function __construct(QuoteInterface $staticQuote) {
        $this->quote = $staticQuote;
    }

    public function getById($id): QuoteInterface {
        return $this->quote;
    }
}