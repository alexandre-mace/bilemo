<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "product_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "show_all",
 *      href = @Hateoas\Route(
 *          "product_list",
 *          absolute = true
 *      )
 * )
 *
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(type="integer", description="The unique identifier of the product.")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Since("1.0")
     * @SWG\Property(type="string", maxLength=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Since("1.0")
     * @SWG\Property(type="string", maxLength=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Since("1.0")
     * @SWG\Property(type="text", maxLength=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Since("1.0")
     * @SWG\Property(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Since("1.0")
     * @SWG\Property(type="string", maxLength=255)
     */
    private $color;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     * @Serializer\Since("1.0")
     * @SWG\Property(type="decimal")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }
}
