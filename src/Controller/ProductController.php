<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

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
     */
    public function show(Product $product)
    {
        return $product;
    }
}
