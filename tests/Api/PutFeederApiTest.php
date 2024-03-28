<?php

declare(strict_types=1);

namespace App\Tests\Api;

use App\Factory\AlnFeederFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Zalas\PHPUnit\Globals\Attribute\Env;
use Zenstruck\Foundry\Test\Factories;

final class PutFeederApiTest extends FeederApiTestCase
{
    use Factories;

    public function testUpdatingFeederName(): void
    {
        $newName = AlnFeederFactory::faker()->name();
        $id = $this->findFeederId(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->putFeederNameRequest($id, $newName);

        $feeder = $this->findFeeder(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->assertEquals($newName, $feeder->getName());
    }

    public function testUpdatingWithOutOfBoundName(): void
    {
        $newName = AlnFeederFactory::faker()->paragraph(16);
        $id = $this->findFeederId(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->putFeederNameRequest($id, $newName);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdatingUnknownFeederId(): void
    {
        $newName = AlnFeederFactory::faker()->firstName();
        $id = random_int(0, PHP_INT_MAX);
        $this->putFeederNameRequest($id, $newName);
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    #[Env('AUTHENTICATION_ENABLED', 'true')]
    public function testUpdatingFeederNameOwnedFeeder(): void
    {
        $newName = AlnFeederFactory::faker()->firstName();
        $id = $this->findFeederId(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->putFeederNameRequest($id, $newName, $this->getUserByEmail('user.feeder@example.com'));
        $this->assertResponseIsSuccessful();
    }

    #[Env('AUTHENTICATION_ENABLED', 'true')]
    public function testUpdatingFeederNameUnownedFeeder(): void
    {
        $newName = AlnFeederFactory::faker()->firstName();
        $id = $this->findFeederId(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->putFeederNameRequest($id, $newName, $this->getUserByEmail('user.nofeeder@example.com'));
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    #[Env('AUTHENTICATION_ENABLED', 'true')]
    public function testUpdatingFeederNameUnauthenticated(): void
    {
        $newName = AlnFeederFactory::faker()->firstName();
        $id = $this->findFeederId(AlnFeederFactory::AVAILABLE_FEEDER_IDENTIFIER);
        $this->putFeederNameRequest($id, $newName);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    private function putFeederNameRequest(int $feederId, string $newName, ?UserInterface $authenticatedAs = null): ResponseInterface
    {
        $client = self::createClient();

        $options = $this
            ->getOptions($authenticatedAs)
            ->setJson(['name' => $newName])
            ->setHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/merge-patch+json',
            ]);

        return $client->request('PATCH', "/feeders/{$feederId}", $options->toArray());
    }
}
