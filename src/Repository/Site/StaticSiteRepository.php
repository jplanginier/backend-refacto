<?php

namespace App\Repository\Site;

use App\Entity\Site\Site;
use App\Entity\Site\SiteInterface;

class StaticSiteRepository implements SiteRepositoryInterface
{
    /**
     * @var SiteInterface
     */
    private $site;

    public function __construct(SiteInterface $site) {
        $this->site = $site;
    }

    public function getById($id): SiteInterface {
        return $this->site;
    }
}