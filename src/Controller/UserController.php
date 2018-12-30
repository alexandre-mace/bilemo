<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use App\Handler\AddUserHandler;
use App\Handler\DeleteUserHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security as DocSecurity;

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
     * @Cache(expires="tomorrow")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all users",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class))
     *     )
     * )
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
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
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     * @Cache(expires="tomorrow")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns one user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="The unique identifier of the user."
     * )
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
     */
    public function show(User $user)
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
     * 
     * @SWG\Response(
     *     response=201,
     *     description="add one user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class))
     *     )
     * )  
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
     */
    public function add(User $user, AddUserHandler $handler, ConstraintViolationList $violations)
    {
        if ($handler->handle($violations, $user)) {
            return $this->view($user, Response::HTTP_CREATED, ['Location' => $this->generateUrl('user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
        }
    }

	/**
	 * @Rest\Delete(
     *     path = "/user/delete/{id}",
     *     name = "user_delete",
     *     requirements = {"user_id"="\d+"}
     * )
     * @Rest\View(StatusCode = 204)
     *
     * @SWG\Response(
     *     response=204,
     *     description="add one user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class))
     *     )
     * )  
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
     */
    public function delete(User $user, DeleteUserHandler $handler)
    {
        $handler->handle($user);
    }
}
