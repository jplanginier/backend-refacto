<?php

use App\Context\ApplicationContext;
use App\Entity\Quote;
use App\Entity\Template;
use App\Repository\DestinationRepository;
use App\TemplateManager;
use PHPUnit\Framework\TestCase;

class TemplateManagerTest extends TestCase
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var Quote
     */
    private $fakedQuote;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        $this->fakedQuote = $this->getFakedQuote();
    }

    /**
     * Closes the mocks
     */
    public function tearDown(): void
    {
    }

    /**
     * @test
     */
    public function test()
    {
        $this->faker = \Faker\Factory::create();

        $destinationId                  = $this->faker->randomNumber();
        $expectedDestination = DestinationRepository::getInstance()->getById($destinationId);
        $expectedUser        = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote($this->faker->randomNumber(), $this->faker->randomNumber(), $destinationId, $this->faker->date());

        $template = new Template(
            1,
            'Votre livraison à [quote:destination_name]',
            "
Bonjour [user:first_name],

Merci de nous avoir contacté pour votre livraison à [quote:destination_name].

Bien cordialement,

L'équipe Calmedica.com
");
        $templateManager = new TemplateManager();

        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote
            ]
        );

        $this->assertEquals('Votre livraison à ' . $expectedDestination->countryName, $message->subject);
        $this->assertEquals("
Bonjour " . $expectedUser->firstname . ",

Merci de nous avoir contacté pour votre livraison à " . $expectedDestination->countryName . ".

Bien cordialement,

L'équipe Calmedica.com
", $message->content);
    }

    public function testQuoteDestinationNameIsReplacedInMessage(): void {
        $data = ['quote' => $this->getFakedQuote()];
        $templateManager = new TemplateManager();
        $template = $this->getTestTemplateWithGivenMessage('[quote:destination_name]');
        $computed = $templateManager->getTemplateComputed($template, $data);

        $expectedDestination = DestinationRepository::getInstance()->getById($data['quote']->destinationId);

        $this->assertEquals($computed->content, $expectedDestination->countryName, $computed->content);
    }

    private function getFakedQuote(): Quote {
        return new Quote($this->faker->randomNumber(), $this->faker->randomNumber(), $this->faker->randomNumber(), $this->faker->date());
    }

    private function getTestTemplateWithGivenMessage(string $message) {
        return new Template(1, 'Fixed subject', $message);
    }
}
