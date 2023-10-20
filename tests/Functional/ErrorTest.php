<?php

namespace App\Tests;

use App\Tests\ErrorTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

 /**
     * @dataProvider 
     */

class ErrorTest extends WebTestCase
{
    public function testAccessAsUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'exemp@yahoo.fr', // Remplacez par le nom d'utilisateur
            'PHP_AUTH_PW' => 'Almamater1!', // Remplacez par le mot de passe
        ]);

        $client->request('GET', '/admin'); // Remplacez par l'URL de la page d'administration

        $this->assertEquals(403, $client->getResponse()->getStatusCode()); // Assurez-vous que l'accès est autorisé (code 200).
    }
}