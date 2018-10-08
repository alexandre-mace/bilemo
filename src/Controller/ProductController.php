<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class ProductController extends AbstractController
{
    /**
     * @Get(
     *     path = "/product/{id}",
     *     name = "product_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(
     *     statusCode = 200
     * )
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * @Get(
     *     path = "/products",
     *     name = "product_list",
     * )
     * @View(
     *     statusCode = 200
     * )
     */
    public function list(EntityManagerInterface $manager)
    {
    	$products = $manager->getRepository(Product::class)->findAll();
    	
    	$serializer = SerializerBuilder::create()->build();
    	$data = $serializer->serialize($products, 'json');

    	$response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
