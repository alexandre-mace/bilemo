<?php

namespace App\Service;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ClientFinder
{
    private $tokenStorage;
    private $manager;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $manager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->manager = $manager;
    }
    public function find()
    {
        $clientName = $this->tokenStorage
            ->getToken()
            ->getUser()
            ->getUsername();
        $client = $this->manager
            ->getRepository(Client::class)
            ->findOneByName(array('name' => $clientName));
        return $client;
    }
}