<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "user_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "show_all",
 *      href = @Hateoas\Route(
 *          "user_list",
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "add_new",
 *      href = @Hateoas\Route(
 *          "user_list",
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "user_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 * @Hateoas\Relation(
 *     "client",
 *     embedded = @Hateoas\Embedded("expr(object.getClient())")
 * )
 * @ExclusionPolicy("all")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Since("1.0")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255
     * )
     * @Serializer\Since("1.0")
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
