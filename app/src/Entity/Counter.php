<?php

namespace App\Entity;

use App\Repository\CounterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CounterRepository::class)
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
     */
    private $numberOfRedirects = 0;

    /**
     * @ORM\OneToOne(targetEntity=Url::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
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
