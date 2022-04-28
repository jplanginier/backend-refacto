<?php

namespace App\Repository\Quote;

use App\Entity\Quote;

interface QuoteRepositoryInterface
{
    public function getById($id) : Quote;
}