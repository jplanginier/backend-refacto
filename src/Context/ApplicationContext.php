<?php

namespace App\Context;

use App\Entity\Site\Site;
use App\Entity\Site\SiteInterface;
use App\Entity\User\User;
use App\Entity\User\UserInterface;
use App\Repository\Destination\DestinationRepositoryInterface;
use App\Repository\Quote\QuoteRepositoryInterface;
use App\Repository\Site\SiteRepositoryInterface;

class ApplicationContext implements ApplicationContextInterface
{
    /**
     * @var Site
     */
    private $currentSite;
    /**
     * @var User
     */
    private $currentUser;
    /**
     * @var DestinationRepositoryInterface
     */
    private $destinationRepository;
    /**
     * @var SiteRepositoryInterface
     */
    private $siteRepository;
    /**
     * @var QuoteRepositoryInterface
     */
    private $quoteRepository;

    public function __construct(
        DestinationRepositoryInterface $destinationRepository,
        SiteRepositoryInterface $siteRepository,
        QuoteRepositoryInterface $quoteRepository
    ) {
        $faker = \Faker\Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
        $this->destinationRepository = $destinationRepository;
        $this->siteRepository = $siteRepository;
        $this->quoteRepository = $quoteRepository;
    }

    public function getCurrentSite(): SiteInterface {
        return $this->currentSite;
    }

    public function getCurrentUser(): UserInterface {
        return $this->currentUser;
    }

    public function getDestinationRepository(): DestinationRepositoryInterface {
        return $this->destinationRepository;
    }

    public function getSiteRepository(): SiteRepositoryInterface {
        return $this->siteRepository;
    }

    public function getQuoteRepository(): QuoteRepositoryInterface {
        return $this->quoteRepository;
    }
}
