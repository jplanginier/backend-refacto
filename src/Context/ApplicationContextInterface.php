<?php

namespace App\Context;

use App\Entity\Site;
use App\Entity\User;
use App\Repository\Destination\DestinationRepositoryInterface;

interface ApplicationContextInterface
{
    public function getCurrentSite(): Site;

    public function getCurrentUser(): User;

    public function getDestinationRepository(): DestinationRepositoryInterface;
}