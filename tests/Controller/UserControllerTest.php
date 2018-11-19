<?php

// Tests/Controller/UserControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserControllerTest extends WebTestCase
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
        $client->request('GET', '/users');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    
    public function testAdd()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/user/add',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name": "test"}'
        );
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
    public function testAddFail()
    {
        $client = $this->createAuthenticatedClient();
        $client->request(
            'POST',
            '/user/add',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name": ""}'
        );
        $this->assertSame(400, $client->getResponse()->getStatusCode());
        $this->assertContains('The JSON sent contains invalid data', $client->getResponse()->getContent());
    }
    public function testShow()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/user/2');
        $this->assertTrue($client->getResponse()->isSuccessful());  
        $this->assertContains('test', $client->getResponse()->getContent());
    }
    public function testDelete()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('DELETE', '/user/delete/2');
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testDeleteFail()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('DELETE', '/user/delete/1');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}