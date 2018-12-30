<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security as DocSecurity;

/**
 * @Cache(expires="tomorrow")
 * @Security("is_granted('ROLE_USER')") 
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
     * @DocSecurity(name="Bearer")
     */
    public function show(Product $product)
    {
        return $product;
    }
}
