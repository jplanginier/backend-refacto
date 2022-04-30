<?php

use App\Context\ApplicationContext;

use App\Context\ApplicationContextInterface;
use App\Entity\Destination\DestinationInterface;
use App\Entity\Quote\Quote;
use App\Entity\Quote\QuoteInterface;
use App\Entity\Site\SiteInterface;
use App\Entity\Template\Template;
use App\Entity\Site\Site;
use App\Repository\Destination\StaticDestinationRepository;
use App\Repository\Quote\StaticQuoteRepository;
use App\Entity\Destination\Destination;
use App\Repository\Site\StaticSiteRepository;
use App\TemplateManager;
use PHPUnit\Framework\TestCase;

class TemplateManagerTest extends TestCase
{
    /**
     * @var ApplicationContextInterface
     */
    private $baseTestContext;

    /**
     * Init the mocks
     */
    public function setUp(): void {
        $this->baseTestContext = $this->buildBaseTestContext();
    }

    /**
     * Closes the mocks
     */
    public function tearDown(): void {
    }

    public function testQuoteDestinationNameIsReplacedInMessage(): void {
        $templateManager = new TemplateManager($this->baseTestContext);
        $template = $this->getTestTemplateWithGivenMessage('[quote:destination_name]');
        $computed = $templateManager->getTemplateComputed($template, ['quote' => $this->baseTestContext->getQuoteRepository()->getById(3)]);
        $expectedCountryName = ($this->baseTestContext->getDestinationRepository()->getById(2))->getCountryName();

        $this->assertEquals($computed->getContent(), $expectedCountryName, $computed->content);
    }

    public function testSubjectAlsoHasReplacementsApplied(): void {
        $templateManager = new TemplateManager($this->baseTestContext);
        $template = new App\Entity\Template\Template(1, '[quote:destination_name]', 'some content');
        $computed = $templateManager->getTemplateComputed($template, ['quote' => $this->baseTestContext->getQuoteRepository()->getById(3)]);
        $expectedCountryName = ($this->baseTestContext->getDestinationRepository()->getById(2))->getCountryName();

        $this->assertEquals($computed->getSubject(), $expectedCountryName, $computed->content);
    }

    public function testOriginalObjectIsNotAlteredDuringReplacement(): void {
        $initialTitle = '[quote:destination_name]';
        $templateManager = new TemplateManager($this->baseTestContext);
        $initialTemplate = new Template(1, $initialTitle, 'some content');
        $computed = $templateManager->getTemplateComputed($initialTemplate, []);

        $this->assertEquals($initialTemplate->getSubject(), $initialTitle, $computed->content);
    }

    public function testNotTaggedTextIsNotModified(): void {
        $notReplacedText = "My little text";
        $templateManager = new TemplateManager($this->baseTestContext);
        $template = $this->getTestTemplateWithGivenMessage($notReplacedText);
        $computed = $templateManager->getTemplateComputed($template, []);

        $this->assertEquals($computed->getContent(), $notReplacedText, $computed->content);
    }


    private function getTestTemplateWithGivenMessage(string $message): Template {
        return new Template(1, 'Fixed subject', $message);
    }

    private function buildBaseTestContext(): ApplicationContextInterface {
        return new ApplicationContext(
            new StaticDestinationRepository($this->getFranceDestination()),
            new StaticSiteRepository($this->getGoogleSite()),
            new StaticQuoteRepository($this->getQuoteForGoogleSiteWithFranceAsDestination())
        );
    }

    private function getFranceDestination(): DestinationInterface {
        return new Destination(1, 'France', 'conjunction ?', 'fr');
    }

    private function getGoogleSite(): SiteInterface {
        return new Site(2, 'https://www.google.fr');
    }

    private function getQuoteForGoogleSiteWithFranceAsDestination(): QuoteInterface {
        return new Quote(3, 2, 1, $this->buildFirstOfJanuary2022DateTime());
    }

    private function buildFirstOfJanuary2022DateTime(): DateTime {
        return DateTime::createFromFormat('Y-m-d', '2022-01-01');
    }
}
