<?php

namespace App\ValueObject;

use App\Context\ApplicationContextInterface;
use App\Entity\Destination;
use App\Entity\Quote\Quote;
use App\Entity\Quote\QuoteInterface;
use App\Entity\User;

class ComputeTemplateVariables implements ComputeTemplateVariablesInterface
{
    public function __construct(array $data, ApplicationContextInterface $applicationContext) {
        $this->data = $data;
        $this->context = $applicationContext;
    }

    public function getQuote(): ?QuoteInterface {
        return (isset($this->data['quote']) and $this->data['quote'] instanceof Quote) ? $this->data['quote'] : null;
    }

    public function getDestination(): ?Destination {
        $quote = $this->getQuote();
        if (!$quote) {
            return null;
        }

        $destinationRepository = $this->context->getDestinationRepository();
        return $destinationRepository->getById($this->getQuote()->getDestinationId());
    }

    public function getUser(): User {
        return (isset($this->data['user']) and ($this->data['user'] instanceof User)) ? $this->data['user'] : $this->context->getCurrentUser();
    }
}