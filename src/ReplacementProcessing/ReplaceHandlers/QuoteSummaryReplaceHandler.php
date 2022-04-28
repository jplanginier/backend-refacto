<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteSummaryReplaceHandler implements ReplaceHandlerInterface
{
    public function replace(string $text, ComputeTemplateVariablesInterface $variables) {
        $quote = $variables->getQuote();
        if (!$quote) {
            return $text;
        }

        return str_replace(
            '[quote:summary]',
            $quote->renderText(),
            $text
        );
    }
}