<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteDestinationNameReplaceHandler implements ReplaceHandlerInterface, ReplaceSinglePatternInterface
{
    const REPLACED_PATTERN = '[quote:destination_name]';

    public function replace(string $text, ComputeTemplateVariablesInterface $variables): string {
        $destination = $variables->getDestination();
        if (!$destination) {
            return $text;
        }

        return str_replace(
            self::REPLACED_PATTERN,
            $destination->countryName,
            $text
        );
    }

    public static function getReplacedPattern(): string {
        return self::REPLACED_PATTERN;
    }
}