<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\User;
use App\Entity\Client;

class UserTest extends TestCase
{
    public function testEntity()
    {
        $user = new User();
        $user->setName('Username test');

        $this->assertEquals('Username test', $user->getName());
        $this->assertNull($user->getId());
    }

    public function testEntityRelations()
    {
        $client = new Client;
        $user = new User();        
        $user->setClient($client);
        $this->assertEquals($client, $user->getClient());
    }
}
