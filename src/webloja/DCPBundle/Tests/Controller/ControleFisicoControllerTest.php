<?php

namespace webloja\DCPBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControleFisicoControllerTest extends WebTestCase
{
    public function testIndexcontrolefisico9000()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/indexControleFisico9000');
    }

}
