<?php

namespace App\Entity\Destination;

class Destination implements DestinationInterface
{
    public $id;
    public $countryName;
    public $conjunction;
    public $name;
    public $computerName;

    public function __construct(int $id, string $countryName, string $conjunction, string $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCountryName(): string {
        return $this->countryName;
    }

    public function getConjunction(): string {
        return $this->conjunction;
    }

    public function getComputerName(): string {
        return $this->computerName;
    }
}
