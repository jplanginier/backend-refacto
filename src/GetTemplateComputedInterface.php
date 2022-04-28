<?php

namespace App;

use App\Entity\Template;

interface GetTemplateComputedInterface
{
    public function getTemplateComputed(Template $tpl, array $data);
}