<?php

namespace App\Entity\Quote;

use DateTime;

class Quote implements QuoteInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $siteId;

    /**
     * @var int
     */
    protected $destinationId;

    /**
     * @var DateTime
     */
    protected $dateQuoted;

    public function __construct(int $id, int $siteId, int $destinationId, DateTime $dateQuoted) {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDestinationId(): int {
        return $this->destinationId;
    }

    public function getSiteId(): int {
        return $this->siteId;
    }

    public function renderHtml(): string {
        return '<p>' . $this->id . '</p>';
    }

    public function renderText(): string {
        return (string)$this->id;
    }
}
