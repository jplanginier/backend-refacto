<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class QuoteSummaryHtmlReplaceHandler implements ReplaceHandlerInterface
{
    public function replace(string $text, ComputeTemplateVariablesInterface $variables): string {
        $quote = $variables->getQuote();
        if (!$quote) {
            return $text;
        }

        return str_replace(
            '[quote:summary_html]',
            $quote->renderHtml(),
            $text
        );
    }
}