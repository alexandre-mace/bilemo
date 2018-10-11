<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\JsonFormExceptionHandler;

class AddUserHandler
{
	private $manager;
	private $jsonFormExceptionHandler;

	public function __construct(EntityManagerInterface $manager, JsonFormExceptionHandler $jsonFormExceptionHandler)
	{
		$this->manager = $manager;
		$this->jsonFormExceptionHandler = $jsonFormExceptionHandler;
	}

	public function Handle($violations, $user)
	{
		$this->jsonFormExceptionHandler->handle($violations);
        $this->manager->persist($user);
        $this->manager->flush();
        return true;
	}
}