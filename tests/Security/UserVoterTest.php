<?php

namespace App\Tests\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\User;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;
use App\Tests\Security\ExposedUserVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class UserVoterTest extends TestCase
{
    public function testAttributeSupports()
    {
        $user = new User;
        $voter = new ExposedUserVoter;
        $this->assertEquals(false, $voter->exposedSupports('abracadabra', $user));
    }
    public function testObjectSupports()
    {
        $client = new Client;
        $voter = new ExposedUserVoter;
        $this->assertEquals(false, $voter->exposedSupports('delete', $client));
    }
    public function testVoteOnAttribute()
    {
        $user = new User;
        $voter = new ExposedUserVoter;
        $token = $this->createMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
        $this->assertEquals(false, $voter->exposedVoteOnAttribute('delete', $user, $token));        
    }
}