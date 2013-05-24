<?php

namespace webloja\DOLBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackAbastecimentoControllerTest extends WebTestCase
{
    public function testRelatorioabastecimentodiario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/relatorioAbastecimentoDiario');
    }

}
