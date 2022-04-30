<?php

namespace App;

use App\Context\ApplicationContext;
use App\Entity\Template\Template;
use App\ReplacementProcessing\ReplacementProcessor;
use App\ValueObject\ComputeTemplateVariables;
use App\ValueObject\ComputeTemplateVariablesInterface;

class TemplateManager implements GetTemplateComputedInterface
{
    /**
     * @var ApplicationContext
     */
    private $appContext;


    public function __construct(ApplicationContext $context) {
        $this->appContext = $context;
    }

    public function getTemplateComputed(Template $tpl, array $data)
    {
        $variables = new ComputeTemplateVariables($data, $this->appContext);

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $variables);
        $replaced->content = $this->computeText($replaced->content, $variables);

        return $replaced;
    }

    private function computeText($text, ComputeTemplateVariablesInterface $variables)
    {
        $replacementProcess = new ReplacementProcessor();
        return $replacementProcess->replacePlaceholders($text, $variables);
    }
}
