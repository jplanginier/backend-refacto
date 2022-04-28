<?php

namespace App;

use App\Context\ApplicationContext;
use App\Entity\Template;
use App\ReplacementProcessing\ReplacementProcessor;
use App\Repository\Quote\FakedQuoteRepository;
use App\Repository\SiteRepository;
use App\ValueObject\ComputeTemplateVariables;
use App\ValueObject\ComputeTemplateVariablesInterface;

class TemplateManager implements GetTemplateComputedInterface
{
    /**
     * @var ApplicationContext
     */
    private $appContext;
    /**
     * @var Repository\Destination\DestinationRepositoryInterface
     */
    private $destinationRepository;

    public function __construct(ApplicationContext $context) {
        $this->appContext = $context;
        $this->destinationRepository = $context->getDestinationRepository();
    }

    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $variables = new ComputeTemplateVariables($data, $this->appContext);

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $variables);
        $replaced->content = $this->computeText($replaced->content, $variables);

        return $replaced;
    }

    private function computeText($text, ComputeTemplateVariablesInterface $variables)
    {
        $replacementProcess = new ReplacementProcessor();
        $text = $replacementProcess->replacePlaceholders($text, $variables);
        /*
         * USER
         * [user:*]
         */
        $_user  = $variables->getUser();
        if($_user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]'       , ucfirst(mb_strtolower($_user->firstname)), $text);
        }

        return $text;
    }
}
