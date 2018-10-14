<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Client;
use App\Entity\User;

class ClientTest extends TestCase
{
    public function testEntity()
    {
        $client = new Client();
        $client->setName('name test');
        $client->setPassword('clientpassword test');
        $client->setIsActive(true);

        $this->assertEquals('name test', $client->getUsername());
        $this->assertEquals('clientpassword test', $client->getPassword());
        $this->assertEquals(true, $client->getIsActive());
        $this->assertNull($client->getId());
    }

    public function testEntityRelations()
    {
        $user = new user;
        $client = new Client();        
        $client->addUser($user);
        $this->assertEquals($user, $client->getUsers()->first());
    }
}
