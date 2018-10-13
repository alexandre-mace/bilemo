<?php

// src/Security/UserVoter.php
namespace App\Security;

use App\Entity\User;
use App\Entity\Client;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
        const VIEW = 'view';
        const DELETE = 'delete';

        protected function supports($attribute, $subject)
        {
         // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::DELETE))) {
            return false;
        }

        // only vote on User objects inside this voter
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $client = $token->getUser();

        if (!$client instanceof Client) {
            // the client must be logged in; if not, deny access
            return false;
        }

        $user = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->hasRight($user, $client);
            case self::DELETE:
                return $this->hasRight($user, $client);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function hasRight(User $user, Client $client)
    {
        return $client === $user->getClient();
    }
}