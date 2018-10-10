<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

final class HomeControllerTest extends PantherTestCase
{
    public function testAbout()
    {

        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');

        $this->assertContains('Login', $crawler->filter('title')->text());
    }
}