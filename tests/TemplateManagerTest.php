<?php

use App\Context\ApplicationContext;

use App\Context\ApplicationContextInterface;
use App\Entity\Destination\DestinationInterface;
use App\Entity\Quote\Quote;
use App\Entity\Quote\QuoteInterface;
use App\Entity\Site\SiteInterface;
use App\Entity\Template\Template;
use App\Entity\Site\Site;
use App\Repository\Destination\FakedDestinationRepository;
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

//    /**
//     * @test
//     */
//    public function test() {
//        $quote = $this->getQuoteForGoogleSiteWithFranceAsDestination();
//        $data = ['quote' => $quote];
//        $destinationId = $this->faker->randomNumber();
//        $expectedDestination = (new FakedDestinationRepository())->getById($destinationId);
//        $expectedUser = $this->fakedContext->getCurrentUser();
//
//        $quote = new Quote($this->faker->randomNumber(), $this->faker->randomNumber(), $destinationId, DateTime::createFromFormat('Y-m-d', $this->faker->date()));
//
//        $template = new Template(
//            1,
//            'Votre livraison à [quote:destination_name]',
//            "
//Bonjour [user:first_name],
//
//Merci de nous avoir contacté pour votre livraison à [quote:destination_name].
//
//Bien cordialement,
//
//L'équipe Calmedica.com
//");
//        $templateManager = new TemplateManager($this->fakedContext);
//
//        $message = $templateManager->getTemplateComputed(
//            $template,
//            [
//                'quote' => $quote
//            ]
//        );
//
//        $this->assertEquals('Votre livraison à ' . $expectedDestination->countryName, $message->subject);
//        $this->assertEquals("
//Bonjour " . $expectedUser->firstname . ",
//
//Merci de nous avoir contacté pour votre livraison à " . $expectedDestination->countryName . ".
//
//Bien cordialement,
//
//L'équipe Calmedica.com
//", $message->content);
//    }

    public function testQuoteDestinationNameIsReplacedInMessage(): void {
        $templateManager = new TemplateManager($this->baseTestContext);
        $template = $this->getTestTemplateWithGivenMessage('[quote:destination_name]');
        $computed = $templateManager->getTemplateComputed($template, ['quote' => $this->baseTestContext->getQuoteRepository()->getById(3)]);
        $expectedCountryName = ($this->baseTestContext->getDestinationRepository()->getById(2))->getCountryName();

        $this->assertEquals($computed->getContent(), $expectedCountryName, $computed->content);
    }

    public function testSubjectAlsoHasReplacementsApplied(): void {
        $templateManager = new TemplateManager($this->baseTestContext);
        $template = new App\Entity\Template\Template(1, '[quote:destination_name]', '');
        $computed = $templateManager->getTemplateComputed($template, ['quote' => $this->baseTestContext->getQuoteRepository()->getById(3)]);
        $expectedCountryName = ($this->baseTestContext->getDestinationRepository()->getById(2))->getCountryName();

        $this->assertEquals($computed->getSubject(), $expectedCountryName, $computed->content);
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
