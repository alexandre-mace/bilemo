<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\JsonFormExceptionHandler;
use App\Service\ClientFinder;

class AddUserHandler
{
	private $manager;
	private $jsonFormExceptionHandler;
	private $clientFinder;

	public function __construct(EntityManagerInterface $manager, JsonFormExceptionHandler $jsonFormExceptionHandler, ClientFinder $clientFinder)
	{
		$this->manager = $manager;
		$this->jsonFormExceptionHandler = $jsonFormExceptionHandler;
		$this->clientFinder = $clientFinder;
	}

	public function Handle($violations, $user)
	{		
		$client = $this->clientFinder->find();
        $user->setClient($client);
		$this->jsonFormExceptionHandler->handle($violations);
        $this->manager->persist($user);
        $this->manager->flush();
        return true;
	}
}