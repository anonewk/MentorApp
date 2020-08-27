<?php

namespace App\Tests;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        // récupérer l'utilisateur test
        $testUser = $userRepository->findOneByEmail('john.doe@example.com');

        // simuler la connexion de $testUser
        $client->loginUser($testUser);

        // test pour voir  si "Parcourir les groupes" apparaît sur la page une fois connecté.
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html body.theme header', 'Parcourir les groupes');
    }

    public function testVisitingWhileAfterLoggedOut()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        // récupérer l'utilisateur test
        $testUser = $userRepository->findOneByEmail('john.doe@example.com');

        // simuler la connexion de $testUser
        $client->loginUser($testUser);

        $client->request('GET', '/logout');

        $client->followRedirect();

        $this->assertResponseIsSuccessful();

         // test pour voir  si "Parcourir les groupes" n'apparaît pas sur la page une fois connecté.
        $this->assertSelectorTextNotContains('html body.theme header', 'Parcourir les groupes');
    }
}
