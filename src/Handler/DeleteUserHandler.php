<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Exception\ResourceValidationException;

class DeleteUserHandler
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

	public function Handle($user)
	{
        $this->manager->remove($user);
        $this->manager->flush();
	}
}