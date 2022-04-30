<?php

namespace App\Entity\User;

class User implements UserInterface
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;

    public function __construct(int $id, string $firstname, string $lastname, string $email) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->firstname;
    }

    public function getLastName(): string {
        return $this->lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }
}
