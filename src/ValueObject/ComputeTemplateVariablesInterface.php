<?php

namespace App\ValueObject;

use App\Entity\Destination;
use App\Entity\Quote\QuoteInterface;
use App\Entity\User;

interface ComputeTemplateVariablesInterface
{
    public function getQuote(): ?QuoteInterface;

    public function getDestination(): ?Destination;

    public function getUser(): User;
}