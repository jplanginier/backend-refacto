<?php

namespace App\Entity\User;

interface UserInterface
{
    public function getId(): int;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;
}