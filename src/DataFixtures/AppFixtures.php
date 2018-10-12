<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use App\Entity\Client;
use App\Entity\Product;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }    
    
    public function load(ObjectManager $manager)
    {
    	$clients = Yaml::parseFile('src/DataFixtures/clients.yaml');
    	$products = Yaml::parseFile('src/DataFixtures/products.yaml');

        foreach ($clients as $clientData) {
        	$client = new Client;
            $client->setUsername($clientData['username']);
            
            $password = $this->encoder->encodePassword($client, 'password');
            $client->setPassword($password);            
            
            $manager->persist($client);
        }

        foreach ($products as $productData) {
            $product = new product();
            $product->setModel($productData['model']);
            $product->setBrand($productData['brand']);
            $product->setDescription($productData['description']);
            $product->setColor($productData['color']);
            $product->setStock($productData['stock']);
            $product->setPrice($productData['price']);
            $manager->persist($product);
        }
        
        $manager->flush();
    }
}
