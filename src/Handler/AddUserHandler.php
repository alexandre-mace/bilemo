<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\JsonFormExceptionHandler;
use App\Service\ClientFinder;

class AddUserHandler
{
	private $manager;
	private $jsonExceptionHandler;
	private $clientFinder;

	public function __construct(EntityManagerInterface $manager, JsonFormExceptionHandler $jsonExceptionHandler, ClientFinder $clientFinder)
	{
		$this->manager = $manager;
		$this->jsonExceptionHandler = $jsonExceptionHandler;
		$this->clientFinder = $clientFinder;
	}

	public function Handle($violations, $user)
	{		
		$client = $this->clientFinder->find();
        $user->setClient($client);
		$this->jsonExceptionHandler->handle($violations);
        $this->manager->persist($user);
        $this->manager->flush();
        return true;
	}
}