<?php

namespace App\Entity\Site;

class Site implements SiteInterface
{
    protected $id;
    protected $url;

    public function __construct(int $id, string $url) {
        $this->id = $id;
        $this->url = $url;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUrl(): string {
        return $this->url;
    }
}
