<?php

namespace App\ValueObject;

use App\Context\ApplicationContextInterface;
use App\Entity\Destination\DestinationInterface;
use App\Entity\Quote\QuoteInterface;
use App\Entity\Site\SiteInterface;
use App\Entity\User\UserInterface;

class ComputeTemplateVariables implements ComputeTemplateVariablesInterface
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var ApplicationContextInterface
     */
    private $context;

    public function __construct(array $data, ApplicationContextInterface $applicationContext) {
        $this->data = $data;
        $this->context = $applicationContext;
    }

    public function getQuote(): ?QuoteInterface {
        return $this->isQuoteParamPesent() && $this->isQuoteParamAValidQuote() ? $this->data['quote'] : null;
    }

    public function getDestination(): ?DestinationInterface {
        $quote = $this->getQuote();
        if (!$quote) {
            return null;
        }

        $destinationRepository = $this->context->getDestinationRepository();
        return $destinationRepository->getById($this->getQuote()->getDestinationId());
    }

    public function getUser(): UserInterface {
        return (isset($this->data['user']) and ($this->data['user'] instanceof UserInterface)) ? $this->data['user'] : $this->context->getCurrentUser();
    }

    public function getSite(): ?SiteInterface {
        $quote = $this->getQuote();
        if (!$quote) {
            return null;
        }

        return $this->context->getSiteRepository()->getById($quote->getSiteId());
    }

    private function isQuoteParamPesent(): bool {
        return isset($this->data['quote']);
    }

    private function isQuoteParamAValidQuote(): bool {
        return $this->data['quote'] instanceof QuoteInterface;
    }
}