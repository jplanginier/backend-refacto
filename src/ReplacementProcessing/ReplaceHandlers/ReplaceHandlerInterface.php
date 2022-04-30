<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

interface ReplaceHandlerInterface
{
    public function replace(string $text, ComputeTemplateVariablesInterface $variables): string;
}