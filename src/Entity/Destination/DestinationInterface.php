<?php

namespace App\Entity\Destination;

interface DestinationInterface
{
    public function getId(): int;

    public function getCountryName(): string;

    public function getConjunction(): string;

    public function getComputerName(): string;
}