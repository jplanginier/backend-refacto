<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

interface ReplaceSinglePatternInterface
{
    public static function getReplacedPattern(): string;
}