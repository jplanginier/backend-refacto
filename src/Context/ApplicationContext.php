<?php

namespace App\Context;

use App\Entity\Site;
use App\Entity\User;
use App\Repository\Destination\DestinationRepositoryInterface;

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

    public function __construct(DestinationRepositoryInterface $destinationRepository) {
        $faker = \Faker\Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
        $this->destinationRepository = $destinationRepository;
    }

    public function getCurrentSite(): Site {
        return $this->currentSite;
    }

    public function getCurrentUser(): User {
        return $this->currentUser;
    }

    public function getDestinationRepository(): DestinationRepositoryInterface {
        return $this->destinationRepository;
    }
}
