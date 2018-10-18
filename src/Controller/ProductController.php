<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security as DocSecurity;

/**
 * @Cache(expires="tomorrow", public=true)
 */
class ProductController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path = "/products",
     *     name = "product_list",
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all products",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class))
     *     )
     * )
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
     */
    public function list(EntityManagerInterface $manager)
    {
    	$products = $manager->getRepository(Product::class)->findAll();
        return $products;
    }
    	
    /**
     * 
     * @Rest\Get(
     *     path = "/product/{id}",
     *     name = "product_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     StatusCode = 200
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns one product",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Product::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="The unique identifier of the product."
     * )
     * @Security("is_granted('ROLE_USER')") 
     * @DocSecurity(name="Bearer")
     */
    public function show(Product $product)
    {
        return $product;
    }
}
