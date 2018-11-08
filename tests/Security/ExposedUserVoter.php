<?php

namespace App\Tests\Security;

use App\Entity\User;
use App\Entity\Client;
use App\Security\UserVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ExposedUserVoter extends UserVoter
{
    public function exposedSupports($attribute, $subject)
    {
    	return $this->supports($attribute, $subject);
    }
    public function exposedVoteOnAttribute($attribute, $object, TokenInterface $token)
    {
    	return $this->voteOnAttribute($attribute, $object, $token);
    }
}