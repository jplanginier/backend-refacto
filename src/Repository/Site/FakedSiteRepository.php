<?php

namespace App\Repository\Site;

use App\Entity\Site\Site;
use App\Entity\Site\SiteInterface;
use Faker\Factory;

class FakedSiteRepository implements SiteRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id): SiteInterface {
        // DO NOT MODIFY THIS METHOD
        $generator = Factory::create();
        $generator->seed($id);

        return new Site($id, $generator->url);
    }
}
