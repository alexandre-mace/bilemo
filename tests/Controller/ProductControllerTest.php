<?php

// Tests/Controller/ProductControllerTest.php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductControllerTest extends WebTestCase
{
    public function testList()
    {
        // $client = self::createClient();
        // $client->request(
        //     'POST',
        //     '/login_check',
        //     array(),
        //     array(),
        //     array('CONTENT_TYPE' => 'application/json'),
        //     '{
        //         "username": "sfr",
        //         "password": "password"
        //     }'
        // );
        // var_dump($client->getResponse()->getContent());die;
        // $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testShow()
    {
    }
}