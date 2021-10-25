<?php

namespace App\Entity;

use App\Repository\UrlRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UrlRepository::class)
 *  @ApiResource(
 *     normalizationContext={"groups"={"url:read"}},
 *     denormalizationContext={"groups"={"url:write"}},
 * )
 * @ORM\EntityListeners({"App\Doctrine\UrlListener"})
 */
class Url
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"url:write", "url:read", "counter:read"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     maxMessage="URL can have max 250 chars"
     * )
     * @Assert\Url(
     *     protocols = {"http", "https"},
     *     message = "The url '{{ value }}' is not a valid url, url needs to start with protocol http or https"
     * )
     */
    private $longUrl;

    /**
     * @ORM\Column(type="string", length=10, unique=true)
     * @Groups({"url:read"})
     */
    private $shortCode;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"url:read"})
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLongUrl(): ?string
    {
        return $this->longUrl;
    }

    public function setLongUrl(string $longUrl): self
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    public function setShortCode(string $shortCode): self
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
