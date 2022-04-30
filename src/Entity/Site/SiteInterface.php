<?php

namespace App\Entity\Site;

interface SiteInterface
{
    public function getId(): int;

    public function getUrl(): string;
}