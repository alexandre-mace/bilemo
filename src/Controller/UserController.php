<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use JMS\Serializer\SerializerBuilder;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;


class UserController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path = "/users",
     *     name = "user_list",
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     */
    public function list(EntityManagerInterface $manager)
    {
    	$users = $manager->getRepository(User::class)->findAll();
    	
    	$serializer = SerializerBuilder::create()->build();
    	$data = $serializer->serialize($users, 'json');

    	$response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * 
     * @Rest\Get(
     *     path = "/user/{id}",
     *     name = "user_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * @Rest\Post(
     *     path="/user/add",
     * 	   name="user_add"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function add(User $user, EntityManagerInterface $manager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

    	$manager->persist($user);
    	$manager->flush();

        return $this->view($user, Response::HTTP_CREATED, ['Location' => $this->generateUrl('user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }

	/**
	 * @Rest\Delete(
     *     path = "/user/delete/{id}",
     *     name = "user_delete",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 204)
     */
    public function delete(User $user, EntityManagerInterface $manager)
    {
    	$manager->remove($user);
    	$manager->flush($user);
    }
}
