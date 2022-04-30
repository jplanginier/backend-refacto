<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteDestinationLinkReplaceHandler implements ReplaceHandlerInterface
{
    public function replace(string $text, ComputeTemplateVariablesInterface $variables) {
        $destination = $variables->getDestination();

        if ($destination) {
            return  str_replace('[quote:destination_link]', $variables->getSite()->getUrl() . '/' . $destination->countryName . '/quote/' . $variables->getQuote()->getId(), $text);
        }

        return str_replace('[quote:destination_link]', '', $text);
    }
}