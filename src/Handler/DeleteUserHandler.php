<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DeleteUserHandler
{
    private $manager;
    private $authChecker;

    public function __construct(EntityManagerInterface $manager, AuthorizationCheckerInterface $authChecker)
    {
        $this->manager = $manager;
        $this->authChecker = $authChecker;
    }

	public function Handle($user)
	{
        if (!$this->authChecker->isGranted('delete', $user)) {
            throw new AccessDeniedException();
        }
        $this->manager->remove($user);
        $this->manager->flush();
	}
}