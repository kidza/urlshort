<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CounterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CounterRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"counter:read"}},
 *     denormalizationContext={"groups"={"counter:write"}},
 * )
 */
class Counter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"counter:read"})
     */
    private $numberOfRedirects = 0;

    /**
     * @ORM\OneToOne(targetEntity=Url::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"counter:read"})
     */
    private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfRedirects(): ?int
    {
        return $this->numberOfRedirects;
    }

    public function setNumberOfRedirects(int $numberOfRedirects): self
    {
        $this->numberOfRedirects = $numberOfRedirects;

        return $this;
    }

    public function getUrl(): ?Url
    {
        return $this->url;
    }

    public function setUrl(Url $url): self
    {
        $this->url = $url;

        return $this;
    }
}
