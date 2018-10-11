<?php

// src/EventListener/UserListener.php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\User;
use App\Service\JsonFormExceptionHandler;


class UserListener
{
    private $jsonFormExceptionHandler;

    public function __construct(JsonFormExceptionHandler $jsonFormExceptionHandler)
    {
        $this->jsonFormExceptionHandler = $jsonFormExceptionHandler;
    }

    public function prePersist(LifecycleEventArgs $args, ConstraintViolationList $violations)
    {
        $entity = $args->getEntity();
        $this->handleExceptions($entity, $violations);
    }

    private function handleExceptions($entity, ConstraintViolationList $violations)
    {
        // upload only works for User entities
        if (!$entity instanceof User) {
            return;
        }

        $this->jsonFormExceptionHandler->handle($violations);
    }
}