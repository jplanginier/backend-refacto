<?php

namespace App\ReplacementProcessing\ReplaceHandlers;

use App\ValueObject\ComputeTemplateVariablesInterface;

class UserFirstNameReplaceHandler implements ReplaceHandlerInterface
{

    public function replace(string $text, ComputeTemplateVariablesInterface $variables) {
        $user = $variables->getUser();

        return str_replace(
            '[user:first_name]',
            ucfirst(mb_strtolower($user->getFirstName())), $text);
    }
}