<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteDestinationLinkReplaceHandler implements ReplaceHandlerInterface, ReplaceSinglePatternInterface
{
    const REPLACED_PATTERN = '[quote:destination_link]';
    const URL_PATTERN = '%s/%s/quote/%d';

    public function replace(string $text, ComputeTemplateVariablesInterface $variables): string {
        $destination = $variables->getDestination();

        return $destination
            ? str_replace(self::REPLACED_PATTERN, $this->buildDestinationUrl($variables), $text)
            : str_replace(self::REPLACED_PATTERN, '', $text);
    }

    public static function getReplacedPattern(): string {
        return self::REPLACED_PATTERN;
    }

    private function buildDestinationUrl(ComputeTemplateVariablesInterface $variables) {
        return sprintf(self::URL_PATTERN,
            $variables->getSite()->getUrl(),
            $variables->getDestination()->getCountryName(),
            $variables->getQuote()->getId()
        );
    }
}