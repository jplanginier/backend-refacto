<?php

namespace App\ReplacementProcessing;

use App\ReplacementProcessing\ReplaceHandlers\QuoteDestinationLinkReplaceHandler;
use App\ReplacementProcessing\ReplaceHandlers\QuoteDestinationNameReplaceHandler;
use App\ReplacementProcessing\ReplaceHandlers\QuoteSummaryHtmlReplaceHandler;
use App\ReplacementProcessing\ReplaceHandlers\QuoteSummaryReplaceHandler;
use App\ReplacementProcessing\ReplaceHandlers\ReplaceHandlerInterface;
use App\ValueObject\ComputeTemplateVariablesInterface;

class ReplacementProcessor
{
    public function replacePlaceholders(string $text, ComputeTemplateVariablesInterface $variables) {
        foreach($this->getHandlers() as $handler) {
            $text = $handler->replace($text, $variables);
        }

        return $text;
    }

    /**
     * @return ReplaceHandlerInterface[]
     */
    private function getHandlers(): array {
        return [
            new QuoteDestinationLinkReplaceHandler(),
            new QuoteSummaryHtmlReplaceHandler(),
            new QuoteSummaryReplaceHandler(),
            new QuoteDestinationNameReplaceHandler(),
        ];
    }
}