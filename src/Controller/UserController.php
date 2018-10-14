<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Handler\AddUserHandler;
use App\Handler\DeleteUserHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class UserController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path = "/users",
     *     name = "user_list",
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     * @Security("is_granted('ROLE_USER')")   
     * @Cache(expires="tomorrow")
     */
    public function list(EntityManagerInterface $manager)
    {
    	$users = $manager->getRepository(User::class)->findByClient($this->getUser());
        return $users;
    }

    /**
     * 
     * @Rest\Get(
     *     path = "/user/{id}",
     *     name = "user_show",
     *     requirements = {"user_id"="\d+"}
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     * @Cache(expires="tomorrow")
     */
    public function show(User $user, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('view', $user);
        return $user;
    }

    /**
     * @Rest\Post(
     *     path="/user/add",
     * 	   name="user_add"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Security("is_granted('ROLE_USER')")   
     */
    public function add(User $user, AddUserHandler $handler, ConstraintViolationList $violations)
    {
        if ($handler->handle($violations, $user)) {
            return $user;
        }
    }

	/**
	 * @Rest\Delete(
     *     path = "/user/delete/{id}",
     *     name = "user_delete",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 204)
     */
    public function delete(User $user, EntityManagerInterface $manager, DeleteUserHandler $handler)
    {
        $handler->handle($user);
    }
}
