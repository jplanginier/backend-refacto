<?php

namespace App\Context;

use App\Entity\Site;
use App\Entity\User;

interface ApplicationContextInterface
{
    public function getCurrentSite(): Site;

    public function getCurrentUser(): User;
}