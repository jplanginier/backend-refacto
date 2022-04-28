<?php

namespace App\Repository\Quote;

use App\Entity\Quote\Quote;

interface QuoteRepositoryInterface
{
    public function getById($id) : Quote;
}