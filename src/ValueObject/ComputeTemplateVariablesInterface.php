<?php

namespace App\ValueObject;

use App\Entity\Destination\DestinationInterface;
use App\Entity\Quote\QuoteInterface;
use App\Entity\Site\SiteInterface;
use App\Entity\User\UserInterface;

interface ComputeTemplateVariablesInterface
{
    public function getQuote(): ?QuoteInterface;

    public function getDestination(): ?DestinationInterface;

    public function getUser(): UserInterface;

    public function getSite(): ?SiteInterface;
}