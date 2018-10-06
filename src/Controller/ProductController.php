<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product)
    {
		$serializer = SerializerBuilder::create()->build();
    	$data = $serializer->serialize($product, 'json');

    	$response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/products", name="product_list")
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
