<?php

// Tests/Controller/ProductControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductControllerTest extends WebTestCase
{
    public function createAuthenticatedClient()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/login_check',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"username":"sfr", "password": "password"}'
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testList()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/products');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testShow()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/product/1');
        $this->assertTrue($client->getResponse()->isSuccessful());  
        $this->assertContains('test', $client->getResponse()->getContent());
    }
}