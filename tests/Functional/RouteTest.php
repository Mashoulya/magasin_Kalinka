<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteTest extends WebTestCase
{
    /**
     * @dataProvider listUrls
     */
    public function testRoutesFounded($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function listUrls()
    {
        return [
            ['/'],
        ];
    }
}