<?php

namespace App\Context;

use App\Entity\Site\SiteInterface;
use App\Entity\User\UserInterface;
use App\Repository\Destination\DestinationRepositoryInterface;
use App\Repository\Quote\QuoteRepositoryInterface;
use App\Repository\Site\SiteRepositoryInterface;

class ApplicationContext implements ApplicationContextInterface
{
    /**
     * @var SiteInterface
     */
    private $currentSite;
    /**
     * @var UserInterface
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
        SiteInterface                  $currentSite,
        UserInterface                  $currentUser,
        DestinationRepositoryInterface $destinationRepository,
        SiteRepositoryInterface        $siteRepository,
        QuoteRepositoryInterface       $quoteRepository
    ) {
        $this->currentSite = $currentSite;
        $this->currentUser = $currentUser;
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
