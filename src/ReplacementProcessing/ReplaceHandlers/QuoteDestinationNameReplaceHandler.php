<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteDestinationNameReplaceHandler implements ReplaceHandlerInterface
{
    public function replace(string $text, ComputeTemplateVariablesInterface $variables) {
        $destination = $variables->getDestination();
        if (!$destination) {
            return null;
        }

        return str_replace(
            '[quote:destination_name]',
            $destination->countryName,
            $text
        );
    }
}