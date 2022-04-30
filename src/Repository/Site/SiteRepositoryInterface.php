<?php

namespace App\Repository\Site;

use App\Entity\Site\Site;
use App\Entity\Site\SiteInterface;

interface SiteRepositoryInterface
{
    public function getById($id): SiteInterface;
}