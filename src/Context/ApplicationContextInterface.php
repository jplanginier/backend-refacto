<?php

namespace App\Context;

use App\Entity\Site\Site;
use App\Entity\Site\SiteInterface;
use App\Entity\User\User;
use App\Entity\User\UserInterface;
use App\Repository\Destination\DestinationRepositoryInterface;
use App\Repository\Quote\QuoteRepositoryInterface;
use App\Repository\Site\SiteRepositoryInterface;

interface ApplicationContextInterface
{
    public function getCurrentSite(): SiteInterface;

    public function getCurrentUser(): UserInterface;

    public function getDestinationRepository(): DestinationRepositoryInterface;

    public function getSiteRepository(): SiteRepositoryInterface;

    public function getQuoteRepository(): QuoteRepositoryInterface;
}