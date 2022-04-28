<?php

namespace App\Entity\Quote;

interface QuoteInterface extends renderQuoteIdAsHtmlInterface, renderQuoteIdAsTextInterface
{
    public function getId();

    public function getDestinationId();

    public function getSiteId();
}