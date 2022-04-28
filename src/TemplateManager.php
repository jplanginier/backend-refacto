<?php

namespace App;

use App\Context\ApplicationContext;
use App\Entity\Template;
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
        $quote = $variables->getQuote();
        if ($quote)
        {
            $_quoteFromRepository = FakedQuoteRepository::getInstance()->getById($quote->getId());
            $usefulObject = SiteRepository::getInstance()->getById($quote->getSiteId());
            $destinationOfQuote = $variables->getDestination();

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = $destinationOfQuote;
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary     = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        $_quoteFromRepository->renderHtml(),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        $_quoteFromRepository->renderText(),
                        $text
                    );
                }
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->countryName,$text);
        }

        if (isset($destination))
            $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->getId(), $text);
        else
            $text = str_replace('[quote:destination_link]', '', $text);

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
