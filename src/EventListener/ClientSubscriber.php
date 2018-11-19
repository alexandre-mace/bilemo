<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Client;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class ClientSubscriber implements EventSubscriber
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) 
    {
        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->encode($args);
    }

    public function encode(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Client) {
            return;
        }

        if ($entity->getPassword()) {
            $password = $this->encoder->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($password);
        }
    }
}