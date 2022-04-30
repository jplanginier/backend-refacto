<?php

namespace App\Repository\Quote;

use App\Entity\Quote\QuoteInterface;

interface QuoteRepositoryInterface
{
    public function getById($id): QuoteInterface;
}